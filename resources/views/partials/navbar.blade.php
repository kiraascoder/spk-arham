<nav class="navbar">
    <div class="container navbar-wrapper">
        <a href="{{ route('home') }}" class="brand">BibitKangkung</a>

        <div class="nav-links">
            <a href="{{ route('home') }}">Beranda</a>

            @auth
                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                @else
                    <a href="{{ route('user.dashboard') }}">Dashboard</a>
                @endif

                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" style="background:none;border:none;color:white;cursor:pointer;font-size:14px;">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    </div>
</nav>
