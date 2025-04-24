<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} @yield('title')</title>
    @vite(['resources/js/app.ts', 'resources/sass/app.scss'])
    @livewireStyles
</head>

<body>
    @livewireScripts
    <div class="container">
        <header>
            <x-nav />
            @yield('header')
        </header>
    </div>
    <div class="container">
        <main class="py-4">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <div class="col-md-4 d-flex align-items-center">
                <span class="mb-3 mb-md-0 text-muted">&copy;{{ date_format(now(), 'Y') }} Safe Families for Children
                    Wisconsin</span>
            </div>
        </footer>
    </div>
</body>

</html>
