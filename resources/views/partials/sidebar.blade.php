<div class="sidebar">
    <h2>BibitKangkung</h2>

    <div class="menu">
        @if (auth()->check() && auth()->user()->role == 'admin')
            <a href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
            <a href="{{ route('admin.criteria.index') }}">Data Kriteria</a>
            <a href="{{ route('admin.training.index') }}">Data Training</a>
            <a href="{{ route('home') }}">Kembali ke Beranda</a>

            <form action="{{ route('logout') }}" method="POST" style="margin-top: 10px;">
                @csrf
                <button type="submit" class="btn btn-primary" style="width: 100%;">Logout</button>
            </form>
        @elseif(auth()->check() && auth()->user()->role == 'user')
            <a href="{{ route('user.dashboard') }}">Dashboard User</a>
            <a href="{{ route('user.classification.create') }}">Klasifikasi Bibit</a>
            <a href="{{ route('user.history.index') }}">Riwayat</a>
            <a href="{{ route('user.profile') }}">Profile</a>
            <a href="{{ route('home') }}">Kembali ke Beranda</a>

            <form action="{{ route('logout') }}" method="POST" style="margin-top: 10px;">
                @csrf
                <button type="submit" class="btn btn-primary" style="width: 100%;">Logout</button>
            </form>
        @else
            <a href="{{ route('home') }}">Beranda</a>
            <a href="{{ route('login') }}">Login</a>
        @endif
    </div>
</div>
