<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SFFC') }} @yield('title')</title>
    @vite(['resources/js/app.ts', 'resources/css/tailwind.scss'])
    @livewireStyles
</head>

<body class="bg-gray-100 font-sans antialiased">
    <div class="flex flex-col min-h-screen justify-between">
        <header class="w-full bg-white shadow">
            @auth
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    <x-nav />
                </div>
            @endauth
            @hasSection('header')
                <div class="bg-blue-600 text-white">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                        @yield('header')
                    </div>
                </div>
            @endif
        </header>
        <main class="py-8">
            @if (session('success'))
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative"
                        role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                </div>
            @endif
            @if ($errors->any())
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative"
                        role="alert">
                        <strong class="font-bold">Whoops! Something went wrong.</strong>
                        <ul class="list-disc list-inside mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            @yield('content')
        </main>
        <footer class="mt-12 py-6 bg-blue-600 text-white text-left text-sm">
            <div>
                <span>&copy;{{ date_format(now(), 'Y') }} Safe Families for Children Wisconsin</span>
            </div>
        </footer>
    </div>
    @livewireScripts
</body>

</html>
