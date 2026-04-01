@extends('layouts.dashboard')

@section('content')
    <a href="#" class="btn btn-primary">Tambah Kriteria</a>

    <div class="table-box">
        <h3>Data Kriteria</h3>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kriteria</th>
                    <th>Tipe</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Warna Daun</td>
                    <td>Kategori</td>
                    <td>Hijau muda, hijau, hijau tua</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Tinggi Tanaman</td>
                    <td>Kategori</td>
                    <td>Pendek, sedang, tinggi</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Jumlah Daun</td>
                    <td>Kategori</td>
                    <td>Sedikit, sedang, banyak</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Ketahanan Hama</td>
                    <td>Kategori</td>
                    <td>Rendah, sedang, tinggi</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
