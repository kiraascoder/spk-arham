@extends('layouts.dashboard')

@section('content')
    <a href="{{ route('admin.criteria.create') }}" class="btn btn-primary">Tambah Kriteria</a>

    <div class="table-box">
        <h3>Data Kriteria</h3>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Tipe</th>
                    <th>Keterangan</th>
                    <th width="180">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($criteria as $criterion)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $criterion->code }}</td>
                        <td>{{ $criterion->name }}</td>
                        <td>{{ $criterion->input_type }}</td>
                        <td>{{ $criterion->description }}</td>
                        <td>
                            <a href="{{ route('admin.criteria.edit', $criterion->id) }}" class="btn"
                                style="border:1px solid #2f855a; color:#2f855a;">
                                Edit
                            </a>

                            <form action="{{ route('admin.criteria.destroy', $criterion->id) }}" method="POST"
                                style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn"
                                    style="border:1px solid #dc2626; color:#dc2626; background:white;">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Belum ada data kriteria.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
