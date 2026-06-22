@extends('layouts.app')

@section('content')
    <div class="card">
        <h2>Reset Password</h2>

        @if ($errors->any())
            <div style="margin-bottom: 15px; padding: 10px; background: #fee2e2; color: #991b1b; border-radius: 8px;">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control"
                    value="{{ old('email', $email) }}" placeholder="Masukkan email" required>
            </div>

            <div class="form-group">
                <label class="form-label">Password Baru</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password baru" required>
            </div>

            <div class="form-group">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru" required>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">
                Simpan Password Baru
            </button>
        </form>
    </div>
@endsection