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
                    'warna_daun' => 'Hijau Tua',
                    'tinggi_tanaman' => 'Tinggi',
                    'jumlah_daun' => 'Banyak',
                    'ketahanan_hama' => 'Tinggi',
                ],
            ],
            [
                'sample_code' => 'S002',
                'class_label' => 'unggul',
                'details' => [
                    'warna_daun' => 'Hijau',
                    'tinggi_tanaman' => 'Tinggi',
                    'jumlah_daun' => 'Banyak',
                    'ketahanan_hama' => 'Sedang',
                ],
            ],
            [
                'sample_code' => 'S003',
                'class_label' => 'unggul',
                'details' => [
                    'warna_daun' => 'Hijau Tua',
                    'tinggi_tanaman' => 'Sedang',
                    'jumlah_daun' => 'Banyak',
                    'ketahanan_hama' => 'Tinggi',
                ],
            ],
            [
                'sample_code' => 'S004',
                'class_label' => 'tidak_unggul',
                'details' => [
                    'warna_daun' => 'Hijau Muda',
                    'tinggi_tanaman' => 'Pendek',
                    'jumlah_daun' => 'Sedikit',
                    'ketahanan_hama' => 'Rendah',
                ],
            ],
            [
                'sample_code' => 'S005',
                'class_label' => 'tidak_unggul',
                'details' => [
                    'warna_daun' => 'Hijau Muda',
                    'tinggi_tanaman' => 'Sedang',
                    'jumlah_daun' => 'Sedikit',
                    'ketahanan_hama' => 'Rendah',
                ],
            ],
            [
                'sample_code' => 'S006',
                'class_label' => 'tidak_unggul',
                'details' => [
                    'warna_daun' => 'Hijau',
                    'tinggi_tanaman' => 'Pendek',
                    'jumlah_daun' => 'Sedikit',
                    'ketahanan_hama' => 'Sedang',
                ],
            ],
        ];

        foreach ($samples as $sampleData) {
            $sample = TrainingSample::updateOrCreate(
                ['sample_code' => $sampleData['sample_code']],
                [
                    'class_label' => $sampleData['class_label'],
                    'source_data' => 'Seeder',
                    'notes' => 'Data awal training sample',
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
                        'option_value' => $value,
                        'normalized_value' => strtolower(str_replace(' ', '_', $value)),
                    ]
                );
            }
        }
    }
}
