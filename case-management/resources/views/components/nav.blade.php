<div id="app">
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/dashboard') }}">
                <img src="{{ asset('images/sffc_logo.jpg') }}" alt="Logo" height="40">
            </a>
            @auth
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @canany(['cases-view', 'cases-create', 'cases-edit', 'cases-delete'])
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('case.*') ? 'active' : '' }}"
                                    href="{{ route('case.index') }}">Cases</a>
                            </li>
                        @endcanany
                        @canany(['intake-view', 'intake-create', 'intake-edit', 'intake-delete'])
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('intake.*') ? 'active' : '' }}"
                                    href="{{ route('intake.index') }}">Intake</a>
                            </li>
                        @endcanany
                        @canany(['families-view', 'families-create', 'families-edit', 'families-delete'])
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('family.*') ? 'active' : '' }}"
                                    href="{{ route('family.index') }}">Families</a>
                            </li>
                        @endcanany
                        @canany(['persons-view', 'persons-create', 'persons-edit', 'persons-delete'])
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('person.*') ? 'active' : '' }}"
                                    href="{{ route('person.index') }}">People</a>
                            </li>
                        @endcanany
                        @canany(['organizations-view', 'organizations-create', 'organizations-edit',
                            'organizations-delete'])
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('organization.*') ? 'active' : '' }}"
                                    href="{{ route('organization.index') }}">Organizations</a>
                            </li>
                        @endcanany
                        @canany(['courses-view', 'courses-create', 'courses-edit', 'courses-delete'])
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('course.*') ? 'active' : '' }}"
                                    href="{{ route('course.index') }}">Training</a>
                            </li>
                        @endcanany
                        @canany(['admin-view', 'admin-create', 'admin-edit', 'admin-delete'])
                            <x-nav-admin />
                        @endcanany
                    </ul>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUser" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->firstName }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownUser">
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
