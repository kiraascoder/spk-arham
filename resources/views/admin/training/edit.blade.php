@extends('layouts.dashboard')

@section('content')
    <div class="form-box">
        <h3 style="margin-bottom: 20px;">Edit Data Training</h3>

        <form action="{{ route('admin.training.update', $trainingSample->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label">Kode Sampel</label>
                <input type="text" name="sample_code" class="form-control"
                    value="{{ old('sample_code', $trainingSample->sample_code) }}">
            </div>

            <div class="form-group">
                <label class="form-label">Kelas</label>
                <select name="class_label" class="form-control">
                    <option value="unggul"
                        {{ old('class_label', $trainingSample->class_label) == 'unggul' ? 'selected' : '' }}>Unggul</option>
                    <option value="tidak_unggul"
                        {{ old('class_label', $trainingSample->class_label) == 'tidak_unggul' ? 'selected' : '' }}>Tidak
                        Unggul</option>
                </select>
            </div>

            @foreach ($criteria as $criterion)
                <div class="form-group">
                    <label class="form-label">{{ $criterion->name }}</label>
                    <select name="criteria[{{ $criterion->id }}]" class="form-control">
                        <option value="">-- Pilih {{ $criterion->name }} --</option>
                        @foreach ($criterion->options as $option)
                            <option value="{{ $option->option_label }}"
                                {{ old('criteria.' . $criterion->id, $detailMap[$criterion->id] ?? '') == $option->option_label ? 'selected' : '' }}>
                                {{ $option->option_label }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endforeach

            <div class="form-group">
                <label class="form-label">Catatan</label>
                <textarea name="notes" class="form-control" rows="4">{{ old('notes', $trainingSample->notes) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.training.index') }}" class="btn"
                style="margin-left:8px; border:1px solid #ccc;">Kembali</a>
        </form>
    </div>
@endsection
