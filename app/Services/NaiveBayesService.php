<?php

namespace App\Services;

use App\Models\Criterion;
use App\Models\TrainingSample;

class NaiveBayesService
{
    public function classify(array $inputData): array
    {
        $trainingSamples = TrainingSample::with('details')->get();

        if ($trainingSamples->isEmpty()) {
            return [
                'predicted_class' => null,
                'probability_unggul' => 0,
                'probability_tidak_unggul' => 0,
                'calculation_details' => [],
            ];
        }

        $classes = ['unggul', 'tidak_unggul'];
        $totalSamples = $trainingSamples->count();

        $logResults = [];
        $calculationDetails = [];

        foreach ($classes as $class) {
            $classSamples = $trainingSamples->where('class_label', $class);
            $classCount = $classSamples->count();

            if ($classCount === 0) {
                $logResults[$class] = log(1e-300);
                $calculationDetails[$class] = [
                    'prior' => 0,
                    'posterior' => 0,
                    'attributes' => [],
                ];
                continue;
            }

            $prior = $classCount / $totalSamples;
            $logPosterior = log($prior);
            $attributeDetails = [];

            foreach ($inputData as $criterionId => $inputValue) {
                $values = [];

                foreach ($classSamples as $sample) {
                    $detail = $sample->details->firstWhere('criterion_id', (int) $criterionId);

                    if ($detail && $detail->numeric_value !== null) {
                        $values[] = (float) $detail->numeric_value;
                    }
                }

                $criterion = Criterion::find($criterionId);
                $criterionName = $criterion ? $criterion->name : 'Kriteria';

                $mean = $this->mean($values);
                $variance = $this->variance($values, $mean);

                if ($variance <= 0) {
                    $variance = 1e-6;
                }

                $density = $this->gaussianPdf((float) $inputValue, $mean, $variance);
                $density = max($density, 1e-300);

                $logPosterior += log($density);

                $attributeDetails[] = [
                    'criterion_id' => $criterionId,
                    'criterion_name' => $criterionName,
                    'input_value' => (float) $inputValue,
                    'mean' => $mean,
                    'variance' => $variance,
                    'density' => $density,
                ];
            }

            $logResults[$class] = $logPosterior;

            $calculationDetails[$class] = [
                'prior' => $prior,
                'log_posterior' => $logPosterior,
                'attributes' => $attributeDetails,
            ];
        }

        $probabilities = $this->softmax($logResults);

        $predictedClass = ($probabilities['unggul'] >= $probabilities['tidak_unggul'])
            ? 'unggul'
            : 'tidak_unggul';

        $calculationDetails['unggul']['posterior'] = $probabilities['unggul'];
        $calculationDetails['tidak_unggul']['posterior'] = $probabilities['tidak_unggul'];

        return [
            'predicted_class' => $predictedClass,
            'probability_unggul' => $probabilities['unggul'],
            'probability_tidak_unggul' => $probabilities['tidak_unggul'],
            'calculation_details' => $calculationDetails,
        ];
    }

    private function mean(array $values): float
    {
        if (count($values) === 0) {
            return 0;
        }

        return array_sum($values) / count($values);
    }

    private function variance(array $values, float $mean): float
    {
        if (count($values) === 0) {
            return 1e-6;
        }

        $sum = 0;
        foreach ($values as $value) {
            $sum += pow($value - $mean, 2);
        }

        return $sum / count($values);
    }

    private function gaussianPdf(float $x, float $mean, float $variance): float
    {
        $coefficient = 1 / sqrt(2 * pi() * $variance);
        $exponent = exp(-pow($x - $mean, 2) / (2 * $variance));

        return $coefficient * $exponent;
    }

    private function softmax(array $logValues): array
    {
        $maxLog = max($logValues);
        $expValues = [];

        foreach ($logValues as $class => $value) {
            $expValues[$class] = exp($value - $maxLog);
        }

        $sumExp = array_sum($expValues);

        return [
            'unggul' => $expValues['unggul'] / $sumExp,
            'tidak_unggul' => $expValues['tidak_unggul'] / $sumExp,
        ];
    }
}
