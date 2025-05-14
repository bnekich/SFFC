<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SFFC') }} @yield('title')</title>
    @vite(['resources/js/app.ts', 'resources/sass/app.scss'])
    @livewireStyles
</head>

<body>
    <div class="container-fluid">
        <header>
            <div class="card">
                <div class="card-header">
                    <x-nav />
                </div>
                <div class="card-title text-center bg-dark text-white">
                    @yield('header')
                </div>
            </div>
        </header>
        <main class="py-4">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            {{-- @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif --}}
            @if ($errors->any())
                <div class="alert alert-warning">
                    <strong>Whoops! Something went wrong.</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('content')
        </main>
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <div class="col-md-4 d-flex align-items-center">
                <span class="mb-3 mb-md-0 text-muted">&copy;{{ date_format(now(), 'Y') }} Safe Families for Children
                    Wisconsin</span>
            </div>
        </footer>
    </div>
    @livewireScripts
</body>

</html>
