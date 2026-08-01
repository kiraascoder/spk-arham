<?php

namespace Database\Seeders;

use App\Models\Classification;
use App\Models\ClassificationDetail;
use App\Models\Criterion;
use App\Models\TrainingSample;
use App\Models\User;
use App\Services\NaiveBayesService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class RespondentClassificationSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Pastikan data training tersedia
        |--------------------------------------------------------------------------
        */

        if (TrainingSample::count() === 0) {
            throw new RuntimeException(
                'Data training belum tersedia. Jalankan TrainingSampleSeeder terlebih dahulu.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Kriteria numerik Gaussian Naive Bayes
        |--------------------------------------------------------------------------
        */

        $criterionCodes = [
            'tinggi_tanaman_cm',
            'jumlah_daun',
            'panjang_daun_cm',
            'persentase_serangan_hama',
        ];

        $criteria = Criterion::query()
            ->whereIn('code', $criterionCodes)
            ->get()
            ->keyBy('code');

        $missingCriteria = collect($criterionCodes)
            ->diff($criteria->keys());

        if ($missingCriteria->isNotEmpty()) {
            throw new RuntimeException(
                'Kriteria berikut belum tersedia: ' .
                $missingCriteria->implode(', ')
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Data klasifikasi setiap responden
        |--------------------------------------------------------------------------
        |
        | Setiap responden memiliki 1 sampai 3 klasifikasi.
        |
        */

        $respondents = [
            [
                'email' => 'jumardin@bibitunggulkangkung.test',
                'classifications' => [
                    [
                        'tinggi_tanaman_cm' => 12.5,
                        'jumlah_daun' => 6,
                        'panjang_daun_cm' => 6.7,
                        'persentase_serangan_hama' => 8,
                    ],
                    [
                        'tinggi_tanaman_cm' => 9.2,
                        'jumlah_daun' => 3,
                        'panjang_daun_cm' => 4.3,
                        'persentase_serangan_hama' => 30,
                    ],
                ],
            ],
            [
                'email' => 'isulang@bibitunggulkangkung.test',
                'classifications' => [
                    [
                        'tinggi_tanaman_cm' => 13.8,
                        'jumlah_daun' => 7,
                        'panjang_daun_cm' => 7.1,
                        'persentase_serangan_hama' => 6,
                    ],
                ],
            ],
            [
                'email' => 'hj.kandu@bibitunggulkangkung.test',
                'classifications' => [
                    [
                        'tinggi_tanaman_cm' => 10.1,
                        'jumlah_daun' => 4,
                        'panjang_daun_cm' => 5.1,
                        'persentase_serangan_hama' => 22,
                    ],
                    [
                        'tinggi_tanaman_cm' => 14.2,
                        'jumlah_daun' => 7,
                        'panjang_daun_cm' => 7.4,
                        'persentase_serangan_hama' => 5,
                    ],
                    [
                        'tinggi_tanaman_cm' => 11.8,
                        'jumlah_daun' => 5,
                        'panjang_daun_cm' => 6.0,
                        'persentase_serangan_hama' => 12,
                    ],
                ],
            ],
            [
                'email' => 'laramang@bibitunggulkangkung.test',
                'classifications' => [
                    [
                        'tinggi_tanaman_cm' => 15.0,
                        'jumlah_daun' => 8,
                        'panjang_daun_cm' => 7.8,
                        'persentase_serangan_hama' => 4,
                    ],
                    [
                        'tinggi_tanaman_cm' => 8.7,
                        'jumlah_daun' => 3,
                        'panjang_daun_cm' => 4.0,
                        'persentase_serangan_hama' => 35,
                    ],
                ],
            ],
            [
                'email' => 'isakka@bibitunggulkangkung.test',
                'classifications' => [
                    [
                        'tinggi_tanaman_cm' => 12.9,
                        'jumlah_daun' => 6,
                        'panjang_daun_cm' => 6.8,
                        'persentase_serangan_hama' => 9,
                    ],
                ],
            ],
            [
                'email' => 'suriati@bibitunggulkangkung.test',
                'classifications' => [
                    [
                        'tinggi_tanaman_cm' => 9.5,
                        'jumlah_daun' => 4,
                        'panjang_daun_cm' => 4.8,
                        'persentase_serangan_hama' => 25,
                    ],
                    [
                        'tinggi_tanaman_cm' => 13.4,
                        'jumlah_daun' => 7,
                        'panjang_daun_cm' => 7.0,
                        'persentase_serangan_hama' => 7,
                    ],
                    [
                        'tinggi_tanaman_cm' => 14.0,
                        'jumlah_daun' => 8,
                        'panjang_daun_cm' => 7.3,
                        'persentase_serangan_hama' => 5,
                    ],
                ],
            ],
            [
                'email' => 'sultan@bibitunggulkangkung.test',
                'classifications' => [
                    [
                        'tinggi_tanaman_cm' => 11.6,
                        'jumlah_daun' => 5,
                        'panjang_daun_cm' => 5.9,
                        'persentase_serangan_hama' => 13,
                    ],
                    [
                        'tinggi_tanaman_cm' => 8.9,
                        'jumlah_daun' => 3,
                        'panjang_daun_cm' => 4.2,
                        'persentase_serangan_hama' => 32,
                    ],
                ],
            ],
            [
                'email' => 'dahlia@bibitunggulkangkung.test',
                'classifications' => [
                    [
                        'tinggi_tanaman_cm' => 13.1,
                        'jumlah_daun' => 6,
                        'panjang_daun_cm' => 6.5,
                        'persentase_serangan_hama' => 8,
                    ],
                ],
            ],
            [
                'email' => 'samsuddin@bibitunggulkangkung.test',
                'classifications' => [
                    [
                        'tinggi_tanaman_cm' => 14.5,
                        'jumlah_daun' => 8,
                        'panjang_daun_cm' => 7.6,
                        'persentase_serangan_hama' => 4,
                    ],
                    [
                        'tinggi_tanaman_cm' => 10.0,
                        'jumlah_daun' => 4,
                        'panjang_daun_cm' => 5.0,
                        'persentase_serangan_hama' => 20,
                    ],
                    [
                        'tinggi_tanaman_cm' => 12.2,
                        'jumlah_daun' => 6,
                        'panjang_daun_cm' => 6.3,
                        'persentase_serangan_hama' => 10,
                    ],
                ],
            ],
            [
                'email' => 'hj.asia@bibitunggulkangkung.test',
                'classifications' => [
                    [
                        'tinggi_tanaman_cm' => 9.0,
                        'jumlah_daun' => 3,
                        'panjang_daun_cm' => 4.1,
                        'persentase_serangan_hama' => 28,
                    ],
                    [
                        'tinggi_tanaman_cm' => 13.7,
                        'jumlah_daun' => 7,
                        'panjang_daun_cm' => 7.2,
                        'persentase_serangan_hama' => 6,
                    ],
                ],
            ],
        ];

        $naiveBayesService = app(NaiveBayesService::class);

        DB::transaction(function () use (
            $respondents,
            $criterionCodes,
            $criteria,
            $naiveBayesService
        ): void {
            foreach ($respondents as $respondentIndex => $respondent) {
                $user = User::query()
                    ->where('email', $respondent['email'])
                    ->first();

                if (!$user) {
                    throw new RuntimeException(
                        "Akun {$respondent['email']} belum tersedia."
                    );
                }

                foreach (
                    $respondent['classifications'] as
                    $classificationIndex => $sample
                ) {
                    /*
                    |--------------------------------------------------------------------------
                    | Mengubah kode kriteria menjadi criterion_id
                    |--------------------------------------------------------------------------
                    */

                    $inputData = [];

                    foreach ($criterionCodes as $criterionCode) {
                        $criterion = $criteria->get($criterionCode);

                        $inputData[$criterion->id] =
                            (float) $sample[$criterionCode];
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Perhitungan Gaussian Naive Bayes
                    |--------------------------------------------------------------------------
                    */

                    $result = $naiveBayesService->classify($inputData);

                    $classificationCode = sprintf(
                        'CLS-RSP-%02d-%02d',
                        $respondentIndex + 1,
                        $classificationIndex + 1
                    );

                    /*
                    |--------------------------------------------------------------------------
                    | Simpan hasil utama klasifikasi
                    |--------------------------------------------------------------------------
                    */

                    $classification = Classification::updateOrCreate(
                        [
                            'classification_code' => $classificationCode,
                        ],
                        [
                            'user_id' => $user->id,
                            'predicted_class' => $result['predicted_class'],
                            'probability_unggul' =>
                                (float) $result['probability_unggul'],
                            'probability_tidak_unggul' =>
                                (float) $result['probability_tidak_unggul'],
                            'pdf_path' => null,
                        ]
                    );

                    /*
                    |--------------------------------------------------------------------------
                    | Hapus detail lama agar tidak terjadi duplikasi
                    |--------------------------------------------------------------------------
                    */

                    ClassificationDetail::query()
                        ->where(
                            'classification_id',
                            $classification->id
                        )
                        ->delete();

                    /*
                    |--------------------------------------------------------------------------
                    | Simpan detail input setiap kriteria
                    |--------------------------------------------------------------------------
                    */

                    foreach ($inputData as $criterionId => $value) {
                        ClassificationDetail::create([
                            'classification_id' => $classification->id,
                            'criterion_id' => $criterionId,
                            'input_value' => (string) $value,
                            'numeric_value' => $value,
                            'normalized_value' => null,
                        ]);
                    }
                }
            }
        });
    }
}