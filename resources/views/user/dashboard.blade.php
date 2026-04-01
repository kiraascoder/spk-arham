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
            <strong>12</strong>
        </div>

        <div class="card">
            <h3>Hasil Terakhir</h3>
            <p>Status klasifikasi terakhir Anda.</p>
            <span class="badge">Unggul</span>
        </div>
    </div>
@endsection
