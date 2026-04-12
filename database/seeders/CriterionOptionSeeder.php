<?php

namespace Database\Seeders;

use App\Models\Criterion;
use App\Models\CriterionOption;
use Illuminate\Database\Seeder;

class CriterionOptionSeeder extends Seeder
{
    public function run(): void
    {
        $options = [
            'warna_daun' => [
                ['option_code' => 'hijau_muda', 'option_label' => 'Hijau Muda'],
                ['option_code' => 'hijau', 'option_label' => 'Hijau'],
                ['option_code' => 'hijau_tua', 'option_label' => 'Hijau Tua'],
            ],
            'tinggi_tanaman' => [
                ['option_code' => 'pendek', 'option_label' => 'Pendek'],
                ['option_code' => 'sedang', 'option_label' => 'Sedang'],
                ['option_code' => 'tinggi', 'option_label' => 'Tinggi'],
            ],
            'jumlah_daun' => [
                ['option_code' => 'sedikit', 'option_label' => 'Sedikit'],
                ['option_code' => 'sedang', 'option_label' => 'Sedang'],
                ['option_code' => 'banyak', 'option_label' => 'Banyak'],
            ],
            'ketahanan_hama' => [
                ['option_code' => 'rendah', 'option_label' => 'Rendah'],
                ['option_code' => 'sedang', 'option_label' => 'Sedang'],
                ['option_code' => 'tinggi', 'option_label' => 'Tinggi'],
            ],
        ];

        foreach ($options as $criterionCode => $criterionOptions) {
            $criterion = Criterion::where('code', $criterionCode)->first();

            if (!$criterion) {
                continue;
            }

            foreach ($criterionOptions as $option) {
                CriterionOption::updateOrCreate(
                    [
                        'criterion_id' => $criterion->id,
                        'option_code' => $option['option_code'],
                    ],
                    [
                        'option_label' => $option['option_label'],
                    ]
                );
            }
        }
    }
}
