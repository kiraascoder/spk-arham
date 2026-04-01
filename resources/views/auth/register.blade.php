@extends('layouts.app')

@section('content')
<div class="card">
    <h2>Register</h2>

    <form action="#" method="POST">
        @csrf

        <div class="form-group">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap">
        </div>

        <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Masukkan email">
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
            <a href="{{ url('/login') }}" style="color:#2f855a; font-weight: bold;">Login</a>
        </p>
    </form>
</div>
@endsection
