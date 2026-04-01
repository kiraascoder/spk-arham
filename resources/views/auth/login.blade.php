@extends('layouts.app')

@section('content')
    <div class="card">
        <h2>Login</h2>

        <form action="#" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Masukkan email">
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password">
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">Login</button>

            <p class="text-center mt-3">
                Belum punya akun?
                <a href="{{ url('/register') }}" style="color:#2f855a; font-weight: bold;">Daftar</a>
            </p>
        </form>
    </div>
@endsection
