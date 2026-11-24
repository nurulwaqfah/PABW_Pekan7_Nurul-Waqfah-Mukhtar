<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | LaporBanjir</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<nav class="navbar">
    <a href="{{ route('laporan.create') }}" class="brand">
        <span class="brand-icon">🌊</span>
        LaporBanjir
    </a>

    <div class="nav-links">
        @auth
            <a href="{{ route('laporan.index') }}">Dashboard</a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-logout">Keluar</button>
            </form>
        @else
            <a href="{{ route('laporan.create') }}">Buat Laporan</a>
            <a href="{{ route('login') }}" class="nav-login">Login Petugas</a>
        @endauth
    </div>
</nav>

<main class="main-container">
    @yield('content')
</main>

<footer class="footer">
    <p>© {{ date('Y') }} LaporBanjir — Sistem Pelaporan Banjir BPBD</p>
</footer>

</body>
</html>