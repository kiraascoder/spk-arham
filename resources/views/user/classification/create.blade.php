@extends('layouts.dashboard')

@section('content')
    <div class="form-box">
        <h3 style="margin-bottom: 20px;">Form Klasifikasi Bibit</h3>

        <form action="{{ route('user.classification.store') }}" method="POST">
            @csrf

            @foreach ($criteria as $criterion)
                <div class="form-group">
                    <label class="form-label">{{ $criterion->name }}</label>
                    <input type="number" step="0.01" name="criteria[{{ $criterion->id }}]" class="form-control"
                        placeholder="Masukkan {{ strtolower($criterion->name) }}"
                        value="{{ old('criteria.' . $criterion->id) }}">
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary">Proses Klasifikasi</button>
        </form>
    </div>
@endsection
