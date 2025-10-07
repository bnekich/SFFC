<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.*') ? 'active' : '' }}" href="#"
        id="navbarDropdownAdmin" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Admin
    </a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdownAdmin">
        @canany(['users-view', 'users-create', 'users-edit', 'users-delete'])
            <li>
                <a class="dropdown-item {{ request()->routeIs('users.index') ? 'active' : '' }}"
                    href="{{ route('users.index') }}">Manage Users</a>
            </li>
        @endcanany
        @canany(['roles-view', 'roles-create', 'roles-edit', 'roles-delete'])
            <li>
                <a class="dropdown-item {{ request()->routeIs('roles.index') ? 'active' : '' }}"
                    href="{{ route('roles.index') }}">Manage Roles</a>
            </li>
        @endcanany
        @canany(['permissions-view', 'permissions-create', 'permissions-edit', 'permissions-delete'])
            <li>
                <a class="dropdown-item {{ request()->routeIs('permissions.index') ? 'active' : '' }}"
                    href="{{ route('permissions.index') }}">Manage Permissions</a>
            </li>
        @endcanany
        @can('auditLogs-view')
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <a class="dropdown-item {{ request()->routeIs('audit-logs.index') ? 'active' : '' }}"
                    href="{{ route('audit-logs.index') }}">Audit Logs</a>
            </li>
        @endcan
        @can('types-view')
            <li>
                <a class="dropdown-item {{ request()->routeIs('organization-types.*') ? 'active' : '' }}"
                    href="{{ route('organization-types.index') }}">Organization Types</a>
            </li>
            {{-- <li>
                <a class="dropdown-item {{ request()->routeIs('relationship-types.*') ? 'active' : '' }}"
                    href="{{ route('relationship-types.index') }}">Relationship Types</a>
            </li>
            <li>
                <a class="dropdown-item {{ request()->routeIs('reminder-types.*') ? 'active' : '' }}"
                    href="{{ route('reminder-types.index') }}">Reminder Types</a>
            </li> --}}
        @endcan
        @can('tags-view')
            <li>
                <a class="dropdown-item {{ request()->routeIs('tag.*') ? 'active' : '' }}"
                    href="{{ route('tag.index') }}">Tags</a>
            </li>
        @endcan
        <li>
            <a class="dropdown-item {{ request()->routeIs('case-statuses.*') ? 'active' : '' }}"
                href="{{ route('case-statuses.index') }}">Case Statuses</a>
        </li>
        <li>
            <a class="dropdown-item {{ request()->routeIs('volunteer-statuses.*') ? 'active' : '' }}"
                href="{{ route('volunteer-statuses.index') }}">Volunteer Statuses</a>
        </li>
    </ul>
</li>
