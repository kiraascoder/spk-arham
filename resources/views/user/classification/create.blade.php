@extends('layouts.dashboard')

@section('content')
    <div class="form-box">
        <h3 style="margin-bottom: 20px;">Form Klasifikasi Bibit</h3>

        <form action="{{ route('user.classification.store') }}" method="POST">
            @csrf

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

            <button type="submit" class="btn btn-primary">Proses Klasifikasi</button>
        </form>
    </div>
@endsection
