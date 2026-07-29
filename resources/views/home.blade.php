@extends('layouts.app')

@section('title', 'Bibit Unggul Kangkung | Gaussian Naive Bayes')

@section('meta_description',
    'Sistem pemilihan bibit unggul tanaman kangkung menggunakan Gaussian Naive Bayes
    berdasarkan tinggi tanaman, jumlah daun, panjang daun, dan serangan hama.')

@section('canonical', route('home'))

@section('content')
    <section class="hero" aria-labelledby="judul-utama">
        <div class="hero-box">
            <h1 id="judul-utama">
                Sistem Pemilihan Bibit Unggul Tanaman Kangkung
            </h1>

            <p>
                Sistem berbasis web untuk membantu pengguna menentukan kualitas
                bibit tanaman kangkung menggunakan metode Gaussian Naive Bayes.
                Proses klasifikasi dilakukan secara cepat, objektif, dan terstruktur
                berdasarkan data pertumbuhan bibit.
            </p>

            @guest
                <a href="{{ route('login') }}" class="btn btn-primary"
                    aria-label="Masuk untuk melakukan klasifikasi bibit kangkung">
                    Mulai Klasifikasi
                </a>

                <a href="{{ route('register') }}" class="btn btn-outline" style="margin-left: 10px;"
                    aria-label="Daftar akun sistem bibit kangkung">
                    Daftar
                </a>
            @endguest

            @auth
                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
                        Buka Dashboard Admin
                    </a>
                @else
                    <a href="{{ route('user.dashboard') }}" class="btn btn-primary">
                        Mulai Klasifikasi Bibit
                    </a>
                @endif
            @endauth

            <div class="features">
                <article class="feature-item">
                    <h2>Input Data Bibit Kangkung</h2>

                    <p>
                        Pengguna memasukkan data tinggi tanaman, jumlah daun,
                        panjang daun rata-rata, dan persentase serangan hama
                        sebagai atribut klasifikasi.
                    </p>
                </article>

                <article class="feature-item">
                    <h2>Perhitungan Gaussian Naive Bayes</h2>

                    <p>
                        Sistem mengolah data bibit berdasarkan data training
                        untuk menghitung probabilitas kelas unggul dan tidak unggul.
                    </p>
                </article>

                <article class="feature-item">
                    <h2>Hasil Klasifikasi Bibit</h2>

                    <p>
                        Sistem menampilkan hasil klasifikasi bibit unggul atau
                        tidak unggul beserta nilai probabilitas dan rincian
                        perhitungannya.
                    </p>
                </article>
            </div>
        </div>
    </section>

    <section class="hero" aria-labelledby="tentang-sistem" style="padding-top: 0;">
        <div class="hero-box">
            <h2 id="tentang-sistem">
                Pemilihan Bibit Kangkung Secara Objektif
            </h2>

            <p>
                Pemilihan bibit merupakan salah satu tahap penting dalam budidaya
                tanaman kangkung. Bibit dengan kondisi pertumbuhan yang baik dan
                tingkat serangan hama yang rendah berpotensi memberikan hasil
                budidaya yang lebih baik.
            </p>

            <p>
                Sistem ini menerapkan metode Gaussian Naive Bayes karena atribut
                yang digunakan berbentuk data numerik. Metode tersebut menghitung
                nilai prior, rata-rata, varians, densitas Gaussian, dan probabilitas
                posterior untuk menentukan kelas akhir bibit.
            </p>
        </div>
    </section>

    <section class="hero" aria-labelledby="cara-kerja" style="padding-top: 0;">
        <div class="hero-box">
            <h2 id="cara-kerja">
                Cara Menggunakan Sistem
            </h2>

            <div class="features">
                <article class="feature-item">
                    <h3>1. Buat Akun</h3>

                    <p>
                        Pengguna melakukan pendaftaran dan login untuk mengakses
                        fitur klasifikasi bibit kangkung.
                    </p>
                </article>

                <article class="feature-item">
                    <h3>2. Masukkan Data</h3>

                    <p>
                        Isi seluruh data pertumbuhan dan kondisi bibit pada
                        formulir klasifikasi yang tersedia.
                    </p>
                </article>

                <article class="feature-item">
                    <h3>3. Lihat Hasil</h3>

                    <p>
                        Sistem memproses data dan menampilkan hasil klasifikasi
                        beserta detail perhitungannya.
                    </p>
                </article>
            </div>
        </div>
    </section>
@endsection
