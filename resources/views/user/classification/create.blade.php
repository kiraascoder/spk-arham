@extends('layouts.dashboard')

@section('content')
<div class="form-box">
    <h3 style="margin-bottom: 20px;">Form Klasifikasi Bibit</h3>

    <form action="#" method="POST">
        @csrf

        <div class="form-group">
            <label class="form-label">Warna Daun</label>
            <select name="warna_daun" class="form-control">
                <option value="">-- Pilih --</option>
                <option>Hijau Muda</option>
                <option>Hijau</option>
                <option>Hijau Tua</option>
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">Tinggi Tanaman</label>
            <select name="tinggi_tanaman" class="form-control">
                <option value="">-- Pilih --</option>
                <option>Pendek</option>
                <option>Sedang</option>
                <option>Tinggi</option>
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">Jumlah Daun</label>
            <select name="jumlah_daun" class="form-control">
                <option value="">-- Pilih --</option>
                <option>Sedikit</option>
                <option>Sedang</option>
                <option>Banyak</option>
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">Ketahanan Hama</label>
            <select name="ketahanan_hama" class="form-control">
                <option value="">-- Pilih --</option>
                <option>Rendah</option>
                <option>Sedang</option>
                <option>Tinggi</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Proses Klasifikasi</button>
    </form>
</div>
@endsection
