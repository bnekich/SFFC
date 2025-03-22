<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.*') ? 'active' : '' }}" href="#"
        id="navbarDropdownAdmin" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
