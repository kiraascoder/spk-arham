@extends('layouts.dashboard')

@section('content')
    <div class="cards">
        <div class="card">
            <h3>Selamat Datang</h3>
            <p>Gunakan sistem ini untuk melakukan klasifikasi bibit kangkung dengan mudah.</p>
        </div>

        <div class="card">
            <h3>Total Klasifikasi</h3>
            <p>Jumlah klasifikasi yang pernah Anda lakukan.</p>
            <strong>{{ $totalClassifications }}</strong>
        </div>

        <div class="card">
            <h3>Hasil Terakhir</h3>
            <p>Status klasifikasi terakhir Anda.</p>
            @if ($lastClassification)
                <span class="badge">{{ strtoupper($lastClassification->predicted_class) }}</span>
            @else
                <span class="small-text">Belum ada data</span>
            @endif
        </div>
    </div>
@endsection
