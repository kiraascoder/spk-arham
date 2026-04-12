<?php

namespace App\Services;

use App\Models\Criterion;
use App\Models\TrainingSample;

class NaiveBayesService
{
    public function classify(array $inputData): array
    {
        $trainingSamples = TrainingSample::with('details', 'details.criterion')->get();

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

        $results = [];
        $calculationDetails = [];

        foreach ($classes as $class) {
            $classSamples = $trainingSamples->where('class_label', $class);
            $classCount = $classSamples->count();

            if ($classCount === 0) {
                $results[$class] = 0;
                $calculationDetails[$class] = [
                    'prior' => 0,
                    'attributes' => [],
                    'posterior' => 0,
                    'class_count' => 0,
                ];
                continue;
            }

            $prior = $classCount / $totalSamples;
            $posterior = $prior;

            $attributeDetails = [];

            foreach ($inputData as $criterionId => $inputValue) {
                $matchCount = 0;

                foreach ($classSamples as $sample) {
                    $detail = $sample->details->firstWhere('criterion_id', (int) $criterionId);

                    if ($detail && strtolower(trim($detail->option_value)) === strtolower(trim($inputValue))) {
                        $matchCount++;
                    }
                }

                $criterion = Criterion::with('options')->find($criterionId);
                $criterionName = $criterion ? $criterion->name : 'Kriteria';
                $optionCount = $criterion ? max($criterion->options->count(), 1) : 1;

                // Laplace smoothing
                $likelihood = ($matchCount + 1) / ($classCount + $optionCount);
                $posterior *= $likelihood;

                $attributeDetails[] = [
                    'criterion_id' => $criterionId,
                    'criterion_name' => $criterionName,
                    'input_value' => $inputValue,
                    'match_count' => $matchCount,
                    'class_count' => $classCount,
                    'option_count' => $optionCount,
                    'likelihood' => $likelihood,
                    'formula' => '(' . $matchCount . ' + 1) / (' . $classCount . ' + ' . $optionCount . ')',
                ];
            }

            $results[$class] = $posterior;

            $calculationDetails[$class] = [
                'prior' => $prior,
                'attributes' => $attributeDetails,
                'posterior' => $posterior,
                'class_count' => $classCount,
                'total_samples' => $totalSamples,
                'prior_formula' => $classCount . ' / ' . $totalSamples,
            ];
        }

        $predictedClass = ($results['unggul'] >= $results['tidak_unggul']) ? 'unggul' : 'tidak_unggul';

        return [
            'predicted_class' => $predictedClass,
            'probability_unggul' => $results['unggul'],
            'probability_tidak_unggul' => $results['tidak_unggul'],
            'calculation_details' => $calculationDetails,
        ];
    }
}
