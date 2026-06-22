@extends('layouts.app')

@section('content')
    <div class="card">
        <h2>Lupa Password</h2>

        <p class="text-center mb-3" style="font-size: 14px; color: #666;">
            Masukkan email Anda, lalu sistem akan mengirim link reset password.
        </p>

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

        <form action="{{ route('password.email') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Masukkan email"
                    value="{{ old('email') }}">
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">Kirim Link Reset</button>

            <p class="text-center mt-3">
                <a href="{{ route('login') }}" style="color:#2f855a; font-weight: bold;">Kembali ke Login</a>
            </p>
        </form>
    </div>
@endsection