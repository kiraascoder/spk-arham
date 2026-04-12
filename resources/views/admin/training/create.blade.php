@extends('layouts.dashboard')

@section('content')
    <div class="form-box">
        <h3 style="margin-bottom: 20px;">Tambah Data Training</h3>

        <form action="{{ route('admin.training.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">Kode Sampel</label>
                <input type="text" name="sample_code" class="form-control" placeholder="Contoh: S007">
            </div>

            <div class="form-group">
                <label class="form-label">Kelas</label>
                <select name="class_label" class="form-control">
                    <option value="">-- Pilih Kelas --</option>
                    <option value="unggul">Unggul</option>
                    <option value="tidak_unggul">Tidak Unggul</option>
                </select>
            </div>

            @foreach ($criteria as $criterion)
                <div class="form-group">
                    <label class="form-label">{{ $criterion->name }}</label>
                    <select name="criteria[{{ $criterion->id }}]" class="form-control">
                        <option value="">-- Pilih {{ $criterion->name }} --</option>
                        @foreach ($criterion->options as $option)
                            <option value="{{ $option->option_label }}">{{ $option->option_label }}</option>
                        @endforeach
                    </select>
                </div>
            @endforeach

            <div class="form-group">
                <label class="form-label">Catatan</label>
                <textarea name="notes" class="form-control" rows="4"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
