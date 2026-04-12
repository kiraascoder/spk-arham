@extends('layouts.dashboard')

@section('content')
    <div class="form-box">
        <h3 style="margin-bottom: 20px;">Tambah Kriteria</h3>

        <form action="{{ route('admin.criteria.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">Nama Kriteria</label>
                <input type="text" name="name" class="form-control" placeholder="Contoh: Warna Daun"
                    value="{{ old('name') }}">
            </div>

            <div class="form-group">
                <label class="form-label">Tipe Input</label>
                <select name="input_type" class="form-control">
                    <option value="">-- Pilih Tipe --</option>
                    <option value="category" {{ old('input_type') == 'category' ? 'selected' : '' }}>Category</option>
                    <option value="number" {{ old('input_type') == 'number' ? 'selected' : '' }}>Number</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="4" placeholder="Masukkan deskripsi kriteria">{{ old('description') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.criteria.index') }}" class="btn"
                style="margin-left:8px; border:1px solid #ccc;">Kembali</a>
        </form>
    </div>
@endsection
