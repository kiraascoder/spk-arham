<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class QuestionnaireRespondentSeeder extends Seeder
{
    public function run(): void
    {
        $password = Hash::make('password123');

        $respondents = [
            [
                'name' => 'Jumardin',
                'email' => 'jumardin@bibitunggulkangkung.test',
            ],
            [
                'name' => 'Isulang',
                'email' => 'isulang@bibitunggulkangkung.test',
            ],
            [
                'name' => 'Hj Kandu',
                'email' => 'hj.kandu@bibitunggulkangkung.test',
            ],
            [
                'name' => 'Laramang',
                'email' => 'laramang@bibitunggulkangkung.test',
            ],
            [
                'name' => 'Isakka',
                'email' => 'isakka@bibitunggulkangkung.test',
            ],
            [
                'name' => 'Suriati',
                'email' => 'suriati@bibitunggulkangkung.test',
            ],
            [
                'name' => 'Sultan',
                'email' => 'sultan@bibitunggulkangkung.test',
            ],
            [
                'name' => 'Dahlia',
                'email' => 'dahlia@bibitunggulkangkung.test',
            ],
            [
                'name' => 'Samsuddin',
                'email' => 'samsuddin@bibitunggulkangkung.test',
            ],
            [
                'name' => 'Hj Asia',
                'email' => 'hj.asia@bibitunggulkangkung.test',
            ],
        ];

        foreach ($respondents as $respondent) {
            User::updateOrCreate(
                [
                    'email' => $respondent['email'],
                ],
                [
                    'name' => $respondent['name'],
                    'password' => $password,
                    'role' => 'user',
                ]
            );
        }
    }
}
