<!doctype html>
<html class="h-full" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SFFC') }} @yield('title')</title>
    @vite(['resources/js/app.ts', 'resources/css/tailwind.scss'])
    @livewireStyles
</head>

<body x-data="{ sidebarOpen: false }" class="grid grid-cols-2 md:grid-cols-[auto_1fr] min-h-screen w-full h-full">

    @auth
        <!-- Mobile menu button -->
        <div class="md:hidden fixed top-0 left-0 p-4 z-50">
            <button @click="sidebarOpen = true" class="text-white focus:outline-none bg-gray-800 p-2 rounded-lg">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
        </div>

        <!-- Mobile menu overlay -->
        <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-in duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" @click="sidebarOpen = false"
            class="fixed inset-0 z-40 bg-black bg-opacity-50 md:hidden"></div>

        <!-- Mobile off-canvas menu -->
        <div x-show="sidebarOpen" x-transition:enter="transition-transform ease-out duration-300"
            x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition-transform ease-in duration-300" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            class="fixed inset-y-0 left-0 w-64 bg-gray-800 text-white p-4 z-50 md:hidden">
            <div class="flex justify-end mb-4">
                <button @click="sidebarOpen = false" class="text-white focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <x-nav-menu />
        </div>
    @endauth

    <!-- Full-width header -->
    <header class="col-span-1 md:col-span-2 bg-blue-600 text-white p-2 text-center font-bold">
        <h3>
            @yield('header')
        </h3>
    </header>

    <!-- Side navigation menu (desktop) -->
    @auth
        <aside class="col-span-1 row-start-2 row-end-3 bg-blue-600 text-white hidden md:block">
            <x-nav-menu />
        </aside>
    @endauth

    <!-- Main content area -->
    <main class="col-span-2 row-start-2 row-end-3 p-8 md:p-8">
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
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative" role="alert">
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

    <!-- Full-width footer -->
    <footer class="col-span-1 md:col-span-2 bg-blue-600 text-white p-4">
        <div>
            <span class="text-center">&copy;{{ date_format(now(), 'Y') }} Safe Families for Children Wisconsin</span>
        </div>
    </footer>

    @livewireScripts
    @yield('styles')
</body>

</html>
