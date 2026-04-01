@extends('layouts.app')

@section('content')
    <section class="hero">
        <div class="hero-box">
            <h1>Sistem Pemilihan Bibit Unggul Tanaman Kangkung</h1>
            <p>
                Aplikasi sederhana untuk membantu pengguna memilih bibit kangkung unggul
                menggunakan metode Naive Bayes secara cepat, mudah, dan terstruktur.
            </p>

            <a href="{{ url('/login') }}" class="btn btn-primary">Mulai Sekarang</a>
            <a href="{{ url('/register') }}" class="btn btn-outline" style="margin-left: 10px;">Daftar</a>

            <div class="features">
                <div class="feature-item">
                    <h3>Input Data Bibit</h3>
                    <p>Masukkan kriteria bibit seperti warna daun, tinggi tanaman, dan jumlah daun.</p>
                </div>
                <div class="feature-item">
                    <h3>Proses Naive Bayes</h3>
                    <p>Sistem akan menghitung dan menentukan kategori bibit unggul atau tidak unggul.</p>
                </div>
                <div class="feature-item">
                    <h3>Hasil Rekomendasi</h3>
                    <p>Tampilkan hasil klasifikasi dengan tampilan yang sederhana dan mudah dipahami.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
