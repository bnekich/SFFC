<!-- Alpine.js state for mobile menu and user dropdown -->
<nav x-data="{ open: false, userDropdownOpen: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/dashboard') }}">
                        <img src="{{ asset('images/sffc_logo.jpg') }}" alt="Logo" class="block h-10 w-auto">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @canany(['cases-view', 'cases-create', 'cases-edit', 'cases-delete'])
                        <x-nav-link :href="route('case.index')" :active="request()->routeIs('case.*')">
                            Cases
                        </x-nav-link>
                    @endcanany
                    @canany(['intake-view', 'intake-create', 'intake-edit', 'intake-delete'])
                        <x-nav-link :href="route('intake.index')" :active="request()->routeIs('intake.*')">
                            Intake
                        </x-nav-link>
                    @endcanany
                    @canany(['families-view', 'families-create', 'families-edit', 'families-delete'])
                        <x-nav-link :href="route('family.index')" :active="request()->routeIs('family.*')">
                            Families
                        </x-nav-link>
                    @endcanany
                    @canany(['persons-view', 'persons-create', 'persons-edit', 'persons-delete'])
                        <x-nav-link :href="route('person.index')" :active="request()->routeIs('person.*')">
                            People
                        </x-nav-link>
                    @endcanany
                    @canany(['organizations-view', 'organizations-create', 'organizations-edit',
                        'organizations-delete'])
                        <x-nav-link :href="route('organization.index')" :active="request()->routeIs('organization.*')">
                            Organizations
                        </x-nav-link>
                    @endcanany
                    @canany(['documents-viewAny', 'documenrs-viewMine', 'documents-downloadAny',
                        'documents-downloadMine', 'documents-upload'])
                        <x-nav-link :href="route('document.index')" :active="request()->routeIs('document.*')">
                            Documents
                        </x-nav-link>
                    @endcanany
                    <x-nav-link :href="route('note.index')" :active="request()->routeIs('note.*')">
                        Notes
                    </x-nav-link>
                    @canany(['admin-view', 'admin-create', 'admin-edit', 'admin-delete'])
                        <x-nav-admin />
                    @endcanany
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
                    <div @click="open = ! open">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </div>

                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute z-50 mt-2 w-48 rounded-md shadow-lg origin-top-right right-0"
                        style="display: none;" @click="open = false">
                        <div class="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white">
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                    class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <!-- Add responsive links here if needed, mirroring the desktop links -->
            <a href="{{ route('case.index') }}"
                class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('case.*') ? 'border-indigo-400 text-indigo-700 bg-indigo-50' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }} text-base font-medium focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">Cases</a>
            {{-- Add other links for mobile view --}}
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();"
                        class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                        {{ __('Log Out') }}
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>
