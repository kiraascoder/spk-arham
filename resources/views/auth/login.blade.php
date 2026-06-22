@extends('layouts.app')

@section('content')
    <div class="card">
        <h2>Login</h2>

        <form action="{{ route('login.post') }}" method="POST">
            @csrf

            @if (session('status'))
                <div style="margin-bottom: 15px; padding: 10px; background: #dcfce7; color: #166534; border-radius: 8px;">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div style="margin-bottom: 15px; padding: 10px; background: #fee2e2; color: #991b1b; border-radius: 8px;">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Masukkan email"
                    value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password">
            </div>

            <div style="margin-top: -5px; margin-bottom: 15px; text-align: right;">
                <a href="{{ route('password.request') }}" style="color:#2f855a; font-size: 14px; font-weight: bold;">
                    Lupa password?
                </a>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">Login</button>

            <p class="text-center mt-3">
                Belum punya akun?
                <a href="{{ route('register') }}" style="color:#2f855a; font-weight: bold;">Daftar</a>
            </p>
        </form>
    </div>
@endsection