<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Hasil Klasifikasi</title>

    <style>
        body {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 12px;
            color: #222;
            line-height: 1.5;
        }

        h1,
        h2,
        h3,
        h4,
        p {
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .header h3 {
            font-size: 14px;
            font-weight: bold;
        }

        .box {
            margin-bottom: 20px;
        }

        .label {
            font-weight: bold;
        }

        .result-box {
            border: 1px solid #999;
            padding: 10px;
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            table-layout: fixed;
        }

        table th,
        table td {
            border: 1px solid #999;
            padding: 6px;
            text-align: left;
            vertical-align: top;
            word-wrap: break-word;
        }

        table th {
            background: #f2f2f2;
            font-weight: bold;
        }

        .mt-10 {
            margin-top: 10px;
        }

        .mt-20 {
            margin-top: 20px;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body>

    @php
        /*
         * Menampilkan angka normal dengan 1 angka di belakang koma.
         * Nilai yang sangat kecil ditampilkan dalam notasi ilmiah.
         *
         * Contoh:
         * 13.633333   menjadi 13.6
         * 0.295555    menjadi 0.3
         * 0.008045    menjadi 8.0E-03
         * 0.000000095 menjadi 9.5E-08
         */
        $formatNumber = function ($value) {
            if ($value === null || $value === '') {
                return '-';
            }

            return number_format((float) $value, 1, '.', '');
        };
    @endphp

    <div class="header">
        <h2>Sistem Pemilihan Bibit Unggul Tanaman Kangkung</h2>
        <h3>Laporan Hasil Klasifikasi Gaussian Naive Bayes</h3>
    </div>

    <div class="box">
        <p>
            <span class="label">Kode Klasifikasi:</span>
            {{ $classification->classification_code }}
        </p>

        <p>
            <span class="label">Nama Pengguna:</span>
            {{ $classification->user->name }}
        </p>

        <p>
            <span class="label">Email:</span>
            {{ $classification->user->email }}
        </p>

        <p>
            <span class="label">Tanggal:</span>
            {{ $classification->created_at->format('d-m-Y H:i') }}
        </p>
    </div>

    <div class="box">
        <h3>Input Kriteria</h3>

        <table>
            <thead>
                <tr>
                    <th style="width: 8%;">No</th>
                    <th style="width: 42%;">Kriteria</th>
                    <th style="width: 50%;">Nilai Input</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($classification->details as $detail)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            {{ $detail->criterion->name }}
                        </td>

                        <td>
                            {{ $formatNumber($detail->numeric_value ?? $detail->input_value) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="box">
        <h3>Hasil Klasifikasi</h3>

        <div class="result-box">
            <p>
                <span class="label">Prediksi:</span>
                {{ strtoupper(str_replace('_', ' ', $classification->predicted_class)) }}
            </p>

            <p>
                <span class="label">Probabilitas Unggul:</span>
                {{ $formatNumber($classification->probability_unggul) }}
            </p>

            <p>
                <span class="label">Probabilitas Tidak Unggul:</span>
                {{ $formatNumber($classification->probability_tidak_unggul) }}
            </p>
        </div>
    </div>

    <div class="box">
        <h3>Detail Perhitungan Gaussian Naive Bayes</h3>

        @foreach ($classification->calculation_details as $className => $detailClass)
            <div class="mt-20">
                <h4>
                    Kelas: {{ strtoupper(str_replace('_', ' ', $className)) }}
                </h4>

                <p class="mt-10">
                    <span class="label">Prior:</span>
                    {{ $formatNumber($detailClass['prior'] ?? 0) }}
                </p>

                <table>
                    <thead>
                        <tr>
                            <th style="width: 22%;">Kriteria</th>
                            <th style="width: 14%;">Input</th>
                            <th style="width: 16%;">Mean</th>
                            <th style="width: 16%;">Variance</th>
                            <th style="width: 32%;">Density</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($detailClass['attributes'] ?? [] as $attribute)
                            <tr>
                                <td>
                                    {{ $attribute['criterion_name'] ?? '-' }}
                                </td>

                                <td>
                                    {{ $formatNumber($attribute['input_value'] ?? 0) }}
                                </td>

                                <td>
                                    {{ $formatNumber($attribute['mean'] ?? 0) }}
                                </td>

                                <td>
                                    {{ $formatNumber($attribute['variance'] ?? 0) }}
                                </td>

                                <td>
                                    {{ $formatNumber($attribute['density'] ?? 0) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <p class="mt-10">
                    <span class="label">
                        Posterior {{ strtoupper(str_replace('_', ' ', $className)) }}:
                    </span>

                    {{ $formatNumber($detailClass['posterior'] ?? 0) }}
                </p>
            </div>
        @endforeach
    </div>

</body>

</html>
