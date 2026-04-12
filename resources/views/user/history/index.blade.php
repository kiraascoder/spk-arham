@extends('layouts.dashboard')

@section('content')
    <div class="table-box">
        <h3>Riwayat Klasifikasi</h3>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Hasil</th>
                    <th>Probabilitas Unggul</th>
                    <th>Probabilitas Tidak Unggul</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($histories as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->classification_code }}</td>
                        <td>{{ strtoupper($item->predicted_class) }}</td>
                        <td>{{ $item->probability_unggul }}</td>
                        <td>{{ $item->probability_tidak_unggul }}</td>
                        <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                        <td>
                            <a href="{{ route('user.classification.result', $item->id) }}" class="btn"
                                style="border:1px solid #2f855a; color:#2f855a;">
                                Detail
                            </a>

                            <a href="{{ route('user.classification.pdf', $item->id) }}" class="btn"
                                style="border:1px solid #2563eb; color:#2563eb;">
                                PDF
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">Belum ada riwayat klasifikasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
