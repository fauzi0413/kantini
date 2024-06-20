<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Kantini | @yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])


    {{-- Icon Fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Icon Bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">Kantini</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @guest
                        @else
                        @if (Auth::user()->role == 'user')
                            <a href="/" class="nav-link">Kantin</a>
                            <a href="/riwayat-pesanan" class="nav-link">Riwayat Pesanan</a>
                        @elseif (Auth::user()->role == 'penjual')
                        <div class="d-block d-lg-none">
                            <a href="/datamenu" class="nav-link"><i class="fa-solid fa-bowl-food me-1"></i> Data Menu</a>
                            <a href="/datatransaksi" class="nav-link"><i class="fa-solid fa-money-bill-transfer"></i> Data Transaksi</a>
                            <a href="/datapesanan" class="nav-link"><i class="fa-solid fa-receipt me-2"></i> Data Pesanan</a>
                        </div>
                        @elseif (Auth::user()->role == 'admin')
                        <div class="d-block d-lg-none">
                            <a href="/dataakun" class="nav-link"><i class="fa-solid fa-street-view me-2"></i> Data Akun All</a>
                            <a href="/dataakun/user" class="nav-link"><i class="fa-solid fa-street-view me-2"></i> Data Akun User</a>
                            <a href="/dataakun/penjual" class="nav-link"><i class="fa-solid fa-street-view me-2"></i> Data Akun Penjual</a>
                            <a href="/dataakun/admin" class="nav-link"><i class="fa-solid fa-street-view me-2"></i> Data Akun Admin</a>
                            <a href="/datakantin" class="nav-link"><i class="fa-solid fa-shop me-2"></i> Data Kantin</a>
                            <a href="/dataruko" class="nav-link"><i class="fa-solid fa-store me-2"></i> Data Ruko</a>
                        </div>
                        @endif
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="">
            @yield('content')
        </main>
    </div>
</body>
</html>
