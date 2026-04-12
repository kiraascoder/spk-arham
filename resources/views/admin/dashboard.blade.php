@extends('layouts.dashboard')

@section('content')
    <div class="cards">
        <div class="card">
            <h3>Total User</h3>
            <p>Jumlah pengguna yang terdaftar dalam sistem.</p>
            <strong>{{ $totalUsers }}</strong>
        </div>

        <div class="card">
            <h3>Data Kriteria</h3>
            <p>Jumlah kriteria yang digunakan dalam proses klasifikasi.</p>
            <strong>{{ $totalCriteria }}</strong>
        </div>

        <div class="card">
            <h3>Data Training</h3>
            <p>Jumlah data latih yang digunakan untuk Naive Bayes.</p>
            <strong>{{ $totalTraining }}</strong>
        </div>

        <div class="card">
            <h3>Total Klasifikasi</h3>
            <p>Jumlah proses klasifikasi yang telah dilakukan user.</p>
            <strong>{{ $totalClassifications }}</strong>
        </div>
    </div>
@endsection
