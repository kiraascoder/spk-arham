<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Hasil Klasifikasi</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #222;
        }

        h1,
        h2,
        h3 {
            margin: 0 0 10px 0;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
        }

        .box {
            margin-bottom: 20px;
        }

        .label {
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th,
        table td {
            border: 1px solid #999;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }

        table th {
            background: #f2f2f2;
        }

        .result {
            padding: 10px;
            background: #e8f5e9;
            border: 1px solid #81c784;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Sistem Pemilihan Bibit Unggul Tanaman Kangkung</h2>
        <h3>Laporan Hasil Klasifikasi</h3>
    </div>

    <div class="box">
        <p><span class="label">Kode Klasifikasi:</span> {{ $classification->classification_code }}</p>
        <p><span class="label">Nama Pengguna:</span> {{ $classification->user->name }}</p>
        <p><span class="label">Email:</span> {{ $classification->user->email }}</p>
        <p><span class="label">Tanggal:</span> {{ $classification->created_at->format('d-m-Y H:i') }}</p>
    </div>

    <div class="box">
        <h3>Input Kriteria</h3>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kriteria</th>
                    <th>Nilai Input</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classification->details as $detail)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $detail->criterion->name }}</td>
                        <td>{{ $detail->input_value }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="box">
        <h3>Hasil Klasifikasi</h3>
        <div class="result">
            <p><span class="label">Prediksi:</span> {{ strtoupper($classification->predicted_class) }}</p>
            <p><span class="label">Probabilitas Unggul:</span> {{ $classification->probability_unggul }}</p>
            <p><span class="label">Probabilitas Tidak Unggul:</span> {{ $classification->probability_tidak_unggul }}
            </p>
        </div>
    </div>

    <div class="box">
        <h3>Detail Perhitungan</h3>

        @foreach ($classification->calculation_details as $className => $detailClass)
            <h4>Kelas: {{ strtoupper($className) }}</h4>
            <p>
                Prior = {{ $detailClass['prior_formula'] ?? '-' }}
                = {{ $detailClass['prior'] ?? 0 }}
            </p>

            <table>
                <thead>
                    <tr>
                        <th>Kriteria</th>
                        <th>Input</th>
                        <th>Jumlah Cocok</th>
                        <th>Jumlah Data Kelas</th>
                        <th>Jumlah Opsi</th>
                        <th>Likelihood</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detailClass['attributes'] ?? [] as $attribute)
                        <tr>
                            <td>{{ $attribute['criterion_name'] }}</td>
                            <td>{{ $attribute['input_value'] }}</td>
                            <td>{{ $attribute['match_count'] }}</td>
                            <td>{{ $attribute['class_count'] }}</td>
                            <td>{{ $attribute['option_count'] }}</td>
                            <td>{{ $attribute['formula'] }} = {{ $attribute['likelihood'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <p style="margin-top: 8px;">
                <span class="label">Posterior {{ strtoupper($className) }}:</span>
                {{ $detailClass['posterior'] ?? 0 }}
            </p>
        @endforeach
    </div>
</body>

</html>
