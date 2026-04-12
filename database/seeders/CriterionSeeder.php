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
                'code' => 'warna_daun',
                'name' => 'Warna Daun',
                'input_type' => 'category',
                'description' => 'Kriteria warna daun bibit kangkung',
            ],
            [
                'code' => 'tinggi_tanaman',
                'name' => 'Tinggi Tanaman',
                'input_type' => 'category',
                'description' => 'Kriteria tinggi tanaman kangkung',
            ],
            [
                'code' => 'jumlah_daun',
                'name' => 'Jumlah Daun',
                'input_type' => 'category',
                'description' => 'Kriteria jumlah daun bibit kangkung',
            ],
            [
                'code' => 'ketahanan_hama',
                'name' => 'Ketahanan Hama',
                'input_type' => 'category',
                'description' => 'Kriteria ketahanan terhadap hama',
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
