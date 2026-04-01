<div class="sidebar">
    <h2>BibitKangkung</h2>

    <div class="menu">
        @if(auth()->check() && auth()->user()->role == 'admin')
            <a href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
            <a href="{{ route('admin.criteria') }}">Data Kriteria</a>
            <a href="{{ route('admin.training') }}">Data Training</a>
            <a href="{{ url('/') }}">Kembali ke Beranda</a>
        @elseif(auth()->check() && auth()->user()->role == 'user')
            <a href="{{ route('user.dashboard') }}">Dashboard User</a>
            <a href="{{ route('user.classification') }}">Klasifikasi Bibit</a>
            <a href="{{ route('user.history') }}">Riwayat</a>
            <a href="{{ route('user.profile') }}">Profile</a>
            <a href="{{ url('/') }}">Kembali ke Beranda</a>
        @else
            <a href="{{ url('/') }}">Beranda</a>
            <a href="{{ url('/login') }}">Login</a>
        @endif
    </div>
</div>
