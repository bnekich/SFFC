<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - @yield('title', 'Case Management')</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    {{-- <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <header>
        <div id="app">
            <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    @auth
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('cases.*') ? 'active' : '' }}"
                                        href="{{ route('cases.index') }}">Cases</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.*') ? 'active' : '' }}"
                                        href="#" id="navbarDropdownAdmin" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        Admin
                                    </a>
                                    @can('manage users')
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownAdmin">
                                            <li>
                                                <a class="dropdown-item {{ request()->routeIs('users') ? 'active' : '' }}"
                                                    href="{{ route('users') }}">Manage Users</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item {{ request()->routeIs('roles.index') ? 'active' : '' }}"
                                                    href="{{ route('roles.index') }}">Manage Roles</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item {{ request()->routeIs('permissions.index') ? 'active' : '' }}"
                                                    href="{{ route('permissions.index') }}">Manage Permissions</a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li>
                                                <a class="dropdown-item {{ request()->routeIs('organization-types.*') ? 'active' : '' }}"
                                                    href="{{ route('organization-types.index') }}">Organization Types</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item {{ request()->routeIs('person-types.*') ? 'active' : '' }}"
                                                    href="{{ route('person-types.index') }}">Person Types</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item {{ request()->routeIs('relationship-types.*') ? 'active' : '' }}"
                                                    href="{{ route('relationship-types.index') }}">Relationship Types</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item {{ request()->routeIs('reminder-types.*') ? 'active' : '' }}"
                                                    href="{{ route('reminder-types.index') }}">Reminder Types</a>
                                            </li>
                                        </ul>
                                    @endcan
                                </li>
                            </ul>
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUser"
                                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ Auth::user()->firstName }}
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownUser">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    @endauth
                </div>
            </nav>
        </div>
    </header>
    <main class="py-4">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @yield('content')
        </div>
    </main>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
</body>

</html>
