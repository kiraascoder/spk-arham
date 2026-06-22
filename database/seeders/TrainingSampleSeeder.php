<?php

namespace Database\Seeders;

use App\Models\Criterion;
use App\Models\TrainingSample;
use App\Models\TrainingSampleDetail;
use Illuminate\Database\Seeder;

class TrainingSampleSeeder extends Seeder
{
    public function run(): void
    {
        $criteria = Criterion::pluck('id', 'code');

        $samples = [
            [
                'sample_code' => 'S001',
                'class_label' => 'unggul',
                'details' => [
                    'tinggi_tanaman_cm' => 14.2,
                    'jumlah_daun' => 6,
                    'panjang_daun_cm' => 6.5,
                    'persentase_serangan_hama' => 5,
                ],
            ],
            [
                'sample_code' => 'S002',
                'class_label' => 'unggul',
                'details' => [
                    'tinggi_tanaman_cm' => 13.8,
                    'jumlah_daun' => 5,
                    'panjang_daun_cm' => 6.2,
                    'persentase_serangan_hama' => 8,
                ],
            ],
            [
                'sample_code' => 'S003',
                'class_label' => 'unggul',
                'details' => [
                    'tinggi_tanaman_cm' => 12.9,
                    'jumlah_daun' => 5,
                    'panjang_daun_cm' => 5.9,
                    'persentase_serangan_hama' => 10,
                ],
            ],
            [
                'sample_code' => 'S004',
                'class_label' => 'tidak_unggul',
                'details' => [
                    'tinggi_tanaman_cm' => 10.1,
                    'jumlah_daun' => 4,
                    'panjang_daun_cm' => 4.8,
                    'persentase_serangan_hama' => 25,
                ],
            ],
            [
                'sample_code' => 'S005',
                'class_label' => 'tidak_unggul',
                'details' => [
                    'tinggi_tanaman_cm' => 9.7,
                    'jumlah_daun' => 3,
                    'panjang_daun_cm' => 4.5,
                    'persentase_serangan_hama' => 30,
                ],
            ],
            [
                'sample_code' => 'S006',
                'class_label' => 'tidak_unggul',
                'details' => [
                    'tinggi_tanaman_cm' => 10.5,
                    'jumlah_daun' => 4,
                    'panjang_daun_cm' => 5.0,
                    'persentase_serangan_hama' => 22,
                ],
            ],
        ];

        foreach ($samples as $sampleData) {
            $sample = TrainingSample::updateOrCreate(
                ['sample_code' => $sampleData['sample_code']],
                [
                    'class_label' => $sampleData['class_label'],
                    'source_data' => 'Seeder Gaussian',
                    'notes' => 'Data training Gaussian Naive Bayes',
                ]
            );

            foreach ($sampleData['details'] as $criterionCode => $value) {
                if (!isset($criteria[$criterionCode])) {
                    continue;
                }

                TrainingSampleDetail::updateOrCreate(
                    [
                        'training_sample_id' => $sample->id,
                        'criterion_id' => $criteria[$criterionCode],
                    ],
                    [
                        'option_value' => null,
                        'numeric_value' => $value,
                        'normalized_value' => null,
                    ]
                );
            }
        }
    }
}
