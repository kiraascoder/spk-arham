@extends('layouts.app')

@section('content')
    <section class="hero">
        <div class="hero-box">
            <h1>Sistem Pemilihan Bibit Unggul Tanaman Kangkung</h1>

            <p>
                Aplikasi sederhana untuk membantu pengguna memilih bibit kangkung unggul
                menggunakan metode Naive Bayes secara cepat, mudah, dan terstruktur.
            </p>

            @guest
                <a href="{{ route('login') }}" class="btn btn-primary">
                    Mulai Sekarang
                </a>

                <a href="{{ route('register') }}"
                    class="btn btn-outline"
                    style="margin-left: 10px;">
                    Daftar
                </a>
            @endguest

            @auth
                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
                        Buka Dashboard
                    </a>
                @else
                    <a href="{{ route('user.dashboard') }}" class="btn btn-primary">
                        Buka Dashboard
                    </a>
                @endif
            @endauth

            <div class="features">
                <div class="feature-item">
                    <h3>Input Data Bibit</h3>
                    <p>
                        Masukkan kriteria bibit seperti tinggi tanaman, jumlah daun,
                        panjang daun rata-rata, dan persentase serangan hama.
                    </p>
                </div>

                <div class="feature-item">
                    <h3>Proses Gaussian Naive Bayes</h3>
                    <p>
                        Sistem menghitung data dan menentukan kategori bibit unggul
                        atau tidak unggul.
                    </p>
                </div>

                <div class="feature-item">
                    <h3>Hasil Rekomendasi</h3>
                    <p>
                        Sistem menampilkan hasil klasifikasi secara sederhana
                        dan mudah dipahami.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection