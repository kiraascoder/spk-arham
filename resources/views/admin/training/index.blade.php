@extends('layouts.dashboard')

@section('content')
    <a href="#" class="btn btn-primary">Tambah Data Training</a>

    <div class="table-box">
        <h3>Data Training</h3>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Sampel</th>
                    <th>Warna Daun</th>
                    <th>Tinggi</th>
                    <th>Jumlah Daun</th>
                    <th>Ketahanan Hama</th>
                    <th>Kelas</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>S001</td>
                    <td>Hijau Tua</td>
                    <td>Tinggi</td>
                    <td>Banyak</td>
                    <td>Tinggi</td>
                    <td><span class="badge">Unggul</span></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>S002</td>
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
