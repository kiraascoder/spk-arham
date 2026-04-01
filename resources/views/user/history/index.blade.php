@extends('layouts.dashboard')

@section('content')
    <div class="table-box">
        <h3>Riwayat Klasifikasi</h3>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Warna Daun</th>
                    <th>Tinggi</th>
                    <th>Jumlah Daun</th>
                    <th>Ketahanan Hama</th>
                    <th>Hasil</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>2026-04-02</td>
                    <td>Hijau Tua</td>
                    <td>Tinggi</td>
                    <td>Banyak</td>
                    <td>Tinggi</td>
                    <td><span class="badge">Unggul</span></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>2026-04-01</td>
                    <td>Hijau Muda</td>
                    <td>Pendek</td>
                    <td>Sedikit</td>
                    <td>Rendah</td>
                    <td>Tidak Unggul</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
