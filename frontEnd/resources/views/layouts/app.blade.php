@php use Illuminate\Support\Facades\Route; @endphp
    <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'MyCoins') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('css/menu.css')}} ">
    <link rel="stylesheet" href="{{ URL::asset('css/coins.css')}} ">
    <link rel="stylesheet" href="{{ URL::asset('css/statistics.css')}} ">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<style>
    @media (max-width: 576px) {
        .langIcon span, .profileIcon a div, .loginName div {
            display: none;
            width: 0;
        }
    }
</style>
<body>
<div id="app">
    <!--Main Navigation-->
    @auth()
        @if(auth()->user()->isAdmin)
            <div class="offcanvas offcanvas-start w-25" id="offcanvas" data-bs-backdrop="false">
                <div class="offcanvas-header">
                    <span id="offcanvas">Developer Menu</span>
                    <a class="btn btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></a>
                </div>
                <div class="offcanvas-body">
                    <ul class="nav row" id="menu">
                        <li class="nav-item">
                            <a href="{{'/'}}" class="nav-link">
                                <i class="fs-5 bi-house"></i><span class="ms-1">Home</span></a>
                        </li>
                        <li>
                            <a href="{{route('places.places')}}" class="nav-link">
                                <i class="fs-5 bi-shop-window"></i><span class="ms-1">Places</span></a>
                        </li>
                        <li>
                            <a href="#" class="nav-link">
                                <i class="fs-5 bi-coin"></i><span class="ms-1">Coins</span></a>
                        </li>
                        <li>
                            <a href="#" class="nav-link">
                                <i class="fs-5 bi-people"></i><span class="ms-1">Users</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        @endif
    @endauth
    <!--Main layout-->
    <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
        <div class="container-fluid fw-bold">
            <!-- Left Side Of Navbar -->
            <div class="col d-flex justify-content-center">
                @auth
                    @if(auth()->user()->isAdmin)
                        <a class="btn" onclick="event.preventDefault();" data-bs-toggle="offcanvas"
                           data-bs-target="#offcanvas">
                            <i class="bi bi-list" data-bs-toggle="offcanvas" data-bs-target="#offcanvas"></i>
                        </a>
                    @endif

                @endauth
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'MyCoins') }}
                </a>
            </div>
            <!-- Center Of Navbar -->
            <div class="col d-flex justify-content-center">
                <div style="border-bottom: 2px solid darkblue">
                    <span>{{ucfirst($detailedUser->nickname ?? File::basename(Request::path()))}}</span>
                </div>
            </div>
            <!-- Right Side Of Navbar -->
            <div class="col d-flex justify-content-center">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <a class="logInIcon my-auto nav-link me-2 pe-2 border-end border-2 border-secondary"
                           href="{{ route('login') }}">{{ __('titles.login') }}</a>
                    @endif
                    @if (Route::has('register'))
                        <a class="registerIcon my-auto nav-link pe-2 border-end border-2 border-secondary"
                           href="{{ route('register') }}">{{ __('titles.register') }}</a>
                    @endif
                @else
                    <div class="profileIcon nav-item dropdown">
                        <a class="nav-link d-flex" data-bs-toggle="dropdown" href="">
                            <img alt="" class="rounded-circle me-1" width="30px" src="{{ asset('assets/avatars/'.auth()->user()->avatar) }}">
                            <div class="my-auto dropdown-toggle">{{ auth()->user()->nickname }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item border-bottom fw-bold" href="{{route('profile')}}">
                                {{ __('profile.profileTitle') }}</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('titles.logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endguest
                <div class="langIcon nav-item dropdown ms-2 my-auto">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <span>{{ strtoupper(App::getLocale())}}</span>
                        @if(App::getLocale() == 'en')
                            <img alt="" width="30px" src="{{asset('assets/flags/gb.png')}}">
                        @else
                            <img alt="" width="30px" src="{{asset('assets/flags/'.App::getLocale().'.png')}}">
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{url('locale/es')}}">ES
                            <img alt="" class="w-25" src="{{asset('assets/flags/es.png')}}"></a>
                        <a class="dropdown-item" href="{{url('locale/en')}}">EN
                            <img alt="" class="w-25" src="{{asset('assets/flags/gb.png')}}"></a>
                        <a class="dropdown-item" href="{{url('locale/fr')}}">FR
                            <img alt="" class="w-25" src="{{asset('assets/flags/fr.png')}}"></a>
                        <a class="dropdown-item" href="{{url('locale/pt')}}">PT
                            <img alt="" class="w-25" src="{{asset('assets/flags/pt.png')}}"></a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <main class="mt-4 mb-4">
        @yield('content')
    </main>
</div>
</body>
</html>
