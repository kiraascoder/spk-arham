@extends('layouts.dashboard')

@section('content')
    <a href="{{ route('admin.training.create') }}" class="btn btn-primary">Tambah Data Training</a>

    <div class="table-box">
        <h3>Data Training</h3>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Sampel</th>
                    <th>Kelas</th>
                    <th>Tanggal</th>
                    <th width="180">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($samples as $sample)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $sample->sample_code }}</td>
                        <td>{{ strtoupper($sample->class_label) }}</td>
                        <td>{{ $sample->created_at->format('d-m-Y') }}</td>
                        <td>
                            <a href="{{ route('admin.training.edit', $sample->id) }}" class="btn"
                                style="border:1px solid #2f855a; color:#2f855a;">
                                Edit
                            </a>

                            <form action="{{ route('admin.training.destroy', $sample->id) }}" method="POST"
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
                        <td colspan="5">Belum ada data training.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
