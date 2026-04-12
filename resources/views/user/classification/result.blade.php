@extends('layouts.dashboard')

@section('content')
    <div class="form-box">
        <h3 style="margin-bottom: 20px;">Hasil Klasifikasi</h3>

        <div class="form-group">
            <label class="form-label">Kode Klasifikasi</label>
            <input type="text" class="form-control" value="{{ $classification->classification_code }}" readonly>
        </div>

        <div class="form-group">
            <label class="form-label">Hasil Prediksi</label>
            <input type="text" class="form-control" value="{{ strtoupper($classification->predicted_class) }}" readonly>
        </div>

        <div class="form-group">
            <label class="form-label">Probabilitas Unggul</label>
            <input type="text" class="form-control" value="{{ $classification->probability_unggul }}" readonly>
        </div>

        <div class="form-group">
            <label class="form-label">Probabilitas Tidak Unggul</label>
            <input type="text" class="form-control" value="{{ $classification->probability_tidak_unggul }}" readonly>
        </div>

        <h4 style="margin:20px 0 10px;">Detail Input</h4>

        @foreach ($classi@extends('layouts.dashboard')

@section('content')
<div class="form-box">
    <h3 style="margin-bottom: 20px;">Hasil Klasifikasi</h3>

    <div class="form-group">
        <label class="form-label">Kode Klasifikasi</label>
        <input type="text" class="form-control" value="{{ $classification->classification_code }}" readonly>
    </div>

    <div class="form-group">
        <label class="form-label">Hasil Prediksi</label>
        <input type="text" class="form-control" value="{{ strtoupper($classification->predicted_class) }}" readonly>
    </div>

    <div class="form-group">
        <label class="form-label">Probabilitas Unggul</label>
        <input type="text" class="form-control" value="{{ $classification->probability_unggul }}" readonly>
    </div>

    <div class="form-group">
        <label class="form-label">Probabilitas Tidak Unggul</label>
        <input type="text" class="form-control" value="{{ $classification->probability_tidak_unggul }}" readonly>
    </div>

    <div style="margin: 20px 0;">
        <a href="{{ route('user.classification.pdf', $classification->id) }}" class="btn btn-primary">
            Download PDF
        </a>
    </div>

    <h4 style="margin:20px 0 10px;">Detail Input</h4>

    @foreach($classification->details as $detail)
        <div class="form-group">
            <label class="form-label">{{ $detail->criterion->name }}</label>
            <input type="text" class="form-control" value="{{ $detail->input_value }}" readonly>
        </div>
    @endforeach

    <h4 style="margin:30px 0 10px;">Detail Perhitungan Naive Bayes</h4>

    @foreach($classification->calculation_details as $className => $detailClass)
        <div class="table-box" style="margin-top:15px;">
            <h4 style="margin-bottom:10px;">Kelas: {{ strtoupper($className) }}</h4>

            <p>
                <strong>Prior:</strong>
                {{ $detailClass['prior_formula'] ?? '-' }}
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
                    @foreach($detailClass['attributes'] ?? [] as $attribute)
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

            <p style="margin-top:10px;">
                <strong>Posterior {{ strtoupper($className) }}:</strong>
                {{ $detailClass['posterior'] ?? 0 }}
            </p>
        </div>
    @endforeach
</div>
@endsectionfication->details as $detail)
            <div class="form-group">
                <label class="form-label">{{ $detail->criterion->name }}</label>
                <input type="text" class="form-control" value="{{ $detail->input_value }}" readonly>
            </div>
        @endforeach
    </div>
@endsection
