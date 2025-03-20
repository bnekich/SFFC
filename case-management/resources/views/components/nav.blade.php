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
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownAdmin">
                                @can('users-view')
                                    <li>
                                        <a class="dropdown-item {{ request()->routeIs('users.index') ? 'active' : '' }}"
                                            href="{{ route('users.index') }}">Manage Users</a>
                                    </li>
                                @endcan
                                @can('roles-view')
                                    <li>
                                        <a class="dropdown-item {{ request()->routeIs('roles.index') ? 'active' : '' }}"
                                            href="{{ route('roles.index') }}">Manage Roles</a>
                                    </li>
                                @endcan
                                @can('permissions-view')
                                    <li>
                                        <a class="dropdown-item {{ request()->routeIs('permissions.index') ? 'active' : '' }}"
                                            href="{{ route('permissions.index') }}">Manage Permissions</a>
                                    </li>
                                @endcan
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                @can('auditLogs-view')
                                    <li>
                                        <a class="dropdown-item {{ request()->routeIs('audit-logs.index') ? 'active' : '' }}"
                                            href="{{ route('audit-logs.index') }}">Audit Logs</a>
                                    </li>
                                @endcan
                                @can('types-create')
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
                                @endcan
                            </ul>
                        </li>
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
