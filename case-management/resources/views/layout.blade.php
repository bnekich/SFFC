<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>

<body>
    <header>
        <h1>Safe Families for Children</h1>
        @yield('header')
    </header>

    <nav>
        <ul class="nav">
            <li><a class="{{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
            <li><a class="{{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a></li>
        </ul>
        @yield('navigation')
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>Footer Section</p>
        @yield('footer')
    </footer>

    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
</body>

</html>
