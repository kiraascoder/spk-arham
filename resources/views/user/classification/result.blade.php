@extends('layouts.dashboard')

@section('content')

    @php
        /*
         * Angka normal ditampilkan 1 angka di belakang koma.
         * Angka sangat kecil ditampilkan dalam notasi ilmiah.
         *
         * Contoh:
         * 13.6333333 menjadi 13.6
         * 0.2955555 menjadi 0.3
         * 0.0080454 menjadi 8.0E-03
         * 0.00000009 menjadi 9.0E-08
         */
        $formatNumber = function ($value) {
            if ($value === null || $value === '') {
                return '-';
            }

            return number_format((float) $value, 1, '.', '');
        };
    @endphp

    <div class="form-box">
        <h3 style="margin-bottom: 20px;">Hasil Klasifikasi</h3>

        <div class="form-group">
            <label class="form-label">Kode Klasifikasi</label>

            <input type="text" class="form-control" value="{{ $classification->classification_code }}" readonly>
        </div>

        <div class="form-group">
            <label class="form-label">Hasil Prediksi</label>

            <input type="text" class="form-control"
                value="{{ strtoupper(str_replace('_', ' ', $classification->predicted_class)) }}" readonly>
        </div>

        <div class="form-group">
            <label class="form-label">Probabilitas Unggul</label>

            <input type="text" class="form-control" value="{{ $formatNumber($classification->probability_unggul) }}"
                readonly>
        </div>

        <div class="form-group">
            <label class="form-label">Probabilitas Tidak Unggul</label>

            <input type="text" class="form-control"
                value="{{ $formatNumber($classification->probability_tidak_unggul) }}" readonly>
        </div>

        <div style="margin: 20px 0;">
            <a href="{{ route('user.classification.pdf', $classification->id) }}" class="btn btn-primary">
                Download PDF
            </a>
        </div>

        <h4 style="margin: 20px 0 10px;">Detail Input</h4>

        @foreach ($classification->details as $detail)
            <div class="form-group">
                <label class="form-label">
                    {{ $detail->criterion->name }}
                </label>

                <input type="text" class="form-control"
                    value="{{ $formatNumber($detail->numeric_value ?? $detail->input_value) }}" readonly>
            </div>
        @endforeach

        <h4 style="margin: 30px 0 10px;">
            Detail Perhitungan Gaussian Naive Bayes
        </h4>

        @if (!empty($classification->calculation_details))
            @foreach ($classification->calculation_details as $className => $detailClass)
                <div class="table-box" style="margin-top: 15px;">

                    <h4 style="margin-bottom: 10px;">
                        Kelas: {{ strtoupper(str_replace('_', ' ', $className)) }}
                    </h4>

                    <p>
                        <strong>Prior:</strong>
                        {{ $formatNumber($detailClass['prior'] ?? 0) }}
                    </p>

                    <table>
                        <thead>
                            <tr>
                                <th>Kriteria</th>
                                <th>Input</th>
                                <th>Mean</th>
                                <th>Variance</th>
                                <th>Density</th>
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

                    <p style="margin-top: 10px;">
                        <strong>
                            Posterior {{ strtoupper(str_replace('_', ' ', $className)) }}:
                        </strong>

                        {{ $formatNumber($detailClass['posterior'] ?? 0) }}
                    </p>
                </div>
            @endforeach
        @else
            <p style="margin-top: 10px;">
                Detail perhitungan tidak tersedia.
            </p>
        @endif
    </div>

@endsection
