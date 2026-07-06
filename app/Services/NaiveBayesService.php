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

        $logPosteriorResults = [];
        $calculationDetails = [];

        foreach ($classes as $className) {
            $classSamples = $trainingSamples->where('class_label', $className);
            $classCount = $classSamples->count();

            if ($classCount === 0) {
                $logPosteriorResults[$className] = log(1e-300);
                $calculationDetails[$className] = [
                    'prior' => 0,
                    'posterior' => 0,
                    'attributes' => [],
                ];
                continue;
            }

            /**
             * RUMUS PRIOR:
             * P(Ck) = jumlah data pada kelas / jumlah seluruh data
             */
            $priorProbability = $classCount / $totalSamples;

            /**
             * RUMUS POSTERIOR (bentuk asli):
             * P(Ck|X) ∝ P(Ck) × Π P(x_i|Ck)
             *
             * Dalam implementasi dipakai log agar numerik stabil:
             * log P(Ck|X) = log P(Ck) + Σ log P(x_i|Ck)
             */
            $logPosterior = log($priorProbability);

            $attributeDetails = [];

            foreach ($inputData as $criterionId => $inputValue) {
                $trainingValues = [];

                foreach ($classSamples as $sample) {
                    $detail = $sample->details->firstWhere('criterion_id', (int) $criterionId);

                    if ($detail && $detail->numeric_value !== null) {
                        $trainingValues[] = (float) $detail->numeric_value;
                    }
                }

                $criterion = Criterion::find($criterionId);
                $criterionName = $criterion ? $criterion->name : 'Kriteria';

                /**
                 * RUMUS MEAN:
                 * μ = Σx / n
                 */
                $mean = $this->calculateMean($trainingValues);

                /**
                 * RUMUS VARIANCE:
                 * σ² = Σ(x - μ)² / n
                 */
                $variance = $this->calculateVariance($trainingValues, $mean);

                if ($variance <= 0) {
                    $variance = 1e-6;
                }

                /**
                 * RUMUS GAUSSIAN PDF:
                 * P(x|Ck) = 1 / √(2πσ²) × exp( - (x - μ)² / (2σ²) )
                 */
                $gaussianLikelihood = $this->calculateGaussianPdf(
                    (float) $inputValue,
                    $mean,
                    $variance
                );

                $gaussianLikelihood = max($gaussianLikelihood, 1e-300);

                /**
                 * Menambahkan log likelihood ke log posterior
                 * log P(Ck|X) = log P(Ck) + Σ log P(x_i|Ck)
                 */
                $logPosterior += log($gaussianLikelihood);

                $attributeDetails[] = [
                    'criterion_id' => $criterionId,
                    'criterion_name' => $criterionName,
                    'input_value' => (float) $inputValue,
                    'mean' => $mean,
                    'variance' => $variance,
                    'density' => $gaussianLikelihood,
                ];
            }

            $logPosteriorResults[$className] = $logPosterior;

            $calculationDetails[$className] = [
                'prior' => $priorProbability,
                'log_posterior' => $logPosterior,
                'attributes' => $attributeDetails,
            ];
        }

        /**
         * Normalisasi hasil log posterior menjadi probabilitas
         */
        $normalizedProbabilities = $this->softmax($logPosteriorResults);

        /**
         * Memilih kelas dengan probabilitas terbesar
         */
        $predictedClass = ($normalizedProbabilities['unggul'] >= $normalizedProbabilities['tidak_unggul'])
            ? 'unggul'
            : 'tidak_unggul';

        $calculationDetails['unggul']['posterior'] = $normalizedProbabilities['unggul'];
        $calculationDetails['tidak_unggul']['posterior'] = $normalizedProbabilities['tidak_unggul'];

        return [
            'predicted_class' => $predictedClass,
            'probability_unggul' => $normalizedProbabilities['unggul'],
            'probability_tidak_unggul' => $normalizedProbabilities['tidak_unggul'],
            'calculation_details' => $calculationDetails,
        ];
    }

    /**
     * RUMUS MEAN:
     * μ = Σx / n
     */
    private function calculateMean(array $values): float
    {
        if (count($values) === 0) {
            return 0;
        }

        return array_sum($values) / count($values);
    }

    /**
     * RUMUS VARIANCE:
     * σ² = Σ(x - μ)² / n
     */
    private function calculateVariance(array $values, float $mean): float
    {
        if (count($values) === 0) {
            return 1e-6;
        }

        $sumOfSquaredDifferences = 0;

        foreach ($values as $value) {
            $sumOfSquaredDifferences += pow($value - $mean, 2);
        }

        return $sumOfSquaredDifferences / count($values);
    }

    /**
     * RUMUS GAUSSIAN PDF:
     * P(x|Ck) = 1 / √(2πσ²) × exp( - (x - μ)² / (2σ²) )
     */
    private function calculateGaussianPdf(float $x, float $mean, float $variance): float
    {
        $frontPart = 1 / sqrt(2 * pi() * $variance);
        $exponentPart = exp(-pow($x - $mean, 2) / (2 * $variance));

        return $frontPart * $exponentPart;
    }

    /**
     * Normalisasi log posterior menjadi probabilitas akhir
     */
    private function softmax(array $logValues): array
    {
        $maxLogValue = max($logValues);
        $expValues = [];

        foreach ($logValues as $className => $value) {
            $expValues[$className] = exp($value - $maxLogValue);
        }

        $sumExpValues = array_sum($expValues);

        return [
            'unggul' => $expValues['unggul'] / $sumExpValues,
            'tidak_unggul' => $expValues['tidak_unggul'] / $sumExpValues,
        ];
    }
}
