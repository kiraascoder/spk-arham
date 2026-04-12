@extends('layouts.app')

@section('content')
    <div class="card">
        <h2>Register</h2>

        <form action="{{ route('register.post') }}" method="POST">
            @csrf

            @if ($errors->any())
                <div style="margin-bottom: 15px; padding: 10px; background: #fee2e2; color: #991b1b; border-radius: 8px;">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap"
                    value="{{ old('name') }}">
            </div>

            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Masukkan email"
                    value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password">
            </div>

            <div class="form-group">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password">
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">Daftar</button>

            <p class="text-center mt-3">
                Sudah punya akun?
                <a href="{{ route('login') }}" style="color:#2f855a; font-weight: bold;">Login</a>
            </p>
        </form>
    </div>
@endsection
