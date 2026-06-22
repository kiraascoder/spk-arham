<?php

namespace Database\Seeders;

use App\Models\Criterion;
use Illuminate\Database\Seeder;

class CriterionSeeder extends Seeder
{
    public function run(): void
    {
        $criteria = [
            [
                'code' => 'tinggi_tanaman_cm',
                'name' => 'Tinggi Tanaman (cm)',
                'input_type' => 'number',
                'description' => 'Tinggi bibit kangkung dalam centimeter',
            ],
            [
                'code' => 'jumlah_daun',
                'name' => 'Jumlah Daun',
                'input_type' => 'number',
                'description' => 'Jumlah daun bibit kangkung dalam helai',
            ],
            [
                'code' => 'panjang_daun_cm',
                'name' => 'Panjang Daun Rata-rata (cm)',
                'input_type' => 'number',
                'description' => 'Panjang rata-rata daun bibit kangkung dalam centimeter',
            ],
            [
                'code' => 'persentase_serangan_hama',
                'name' => 'Persentase Serangan Hama (%)',
                'input_type' => 'number',
                'description' => 'Persentase daun yang terserang hama',
            ],
        ];

        foreach ($criteria as $criterion) {
            Criterion::updateOrCreate(
                ['code' => $criterion['code']],
                $criterion
            );
        }
    }
}
