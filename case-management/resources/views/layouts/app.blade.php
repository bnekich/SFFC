<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    {{-- <style>
        .navbar-background {
            position: relative;
            height: 100px;
        }

        .navbar-background::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset('images/sffc_logo.jpg') }}');
            background-size: contain;
            /* Adjust the size of the background image */
            background-repeat: no-repeat;
            /* Prevent the image from repeating */
            background-position: center;
            /* Center the image */
            opacity: 0.1;
            /* Adjust the opacity to make it look like a watermark */
            z-index: 1;
        }

        .navbar {
            position: relative;
            z-index: 2;
            /* Ensure the navbar content is above the background image */
        }
    </style> --}}

</head>

<body>
    <header>
        <div id="app">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                {{-- <nav class="navbar navbar-expand-lg navbar-background"> --}}
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Admin
                                </a>
                                @can('manage users')
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li>
                                            <a class="dropdown-item nav-link {{ request()->routeIs('users') ? 'active' : '' }}"
                                                aria-current="page" href="{{ route('users') }}">Manage Users</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item nav-link {{ request()->routeIs('roles.index') ? 'active' : '' }}"
                                                aria-current="page" href="{{ route('roles.index') }}">Manage Roles</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item nav-link {{ request()->routeIs('permissions.index') ? 'active' : '' }}"
                                                aria-current="page" href="{{ route('permissions.index') }}">Manage
                                                Permissions</a>
                                        </li>
                                    </ul>
                                @endcan
                            </li>
                        </ul>

                        @auth
                            <ul class="navbar-nav ms-auto">
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ Auth::user()->firstName }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        @endauth
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <main class="py-4">
        @yield('content')
    </main>
</body>

</html>
