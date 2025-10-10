<div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <div @click="open = ! open">
        <button
            class="inline-flex px-1 pt-1  {{ request()->routeIs('admin.*', 'users.*', 'roles.*', 'permissions.*') ? 'border-indigo-400 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium leading-5 focus:outline-none transition duration-150 ease-in-out">
            <span>Admin</span>
            <svg class="fill-current h-4 w-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
            </svg>
        </button>
    </div>

    <div x-show="open" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute z-50 mt-2 w-48 rounded-md shadow-lg origin-top-right right-0" style="display: none;"
        @click="open = false">
        <div class="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white">
            @canany(['users-view', 'users-create', 'users-edit', 'users-delete'])
                <x-dropdown-link :href="route('users.index')" :active="request()->routeIs('users.index')">Manage Users</x-dropdown-link>
            @endcanany
            @canany(['roles-view', 'roles-create', 'roles-edit', 'roles-delete'])
                <x-dropdown-link :href="route('roles.index')" :active="request()->routeIs('roles.index')">Manage Roles</x-dropdown-link>
            @endcanany
            @canany(['permissions-view', 'permissions-create', 'permissions-edit', 'permissions-delete'])
                <x-dropdown-link :href="route('permissions.index')" :active="request()->routeIs('permissions.index')">Manage Permissions</x-dropdown-link>
            @endcanany
            @can('auditLogs-view')
                <div class="border-t border-gray-200"></div>
                <x-dropdown-link :href="route('audit-logs.index')" :active="request()->routeIs('audit-logs.index')">Audit Logs</x-dropdown-link>
            @endcan
            @can('types-view')
                <x-dropdown-link :href="route('organization-types.index')" :active="request()->routeIs('organization-types.*')">Organization Types</x-dropdown-link>
            @endcan
            @can('tags-view')
                <x-dropdown-link :href="route('tag.index')" :active="request()->routeIs('tag.*')">Tags</x-dropdown-link>
            @endcan
            <x-dropdown-link :href="route('case-statuses.index')" :active="request()->routeIs('case-statuses.*')">Case Statuses</x-dropdown-link>
            <x-dropdown-link :href="route('volunteer-statuses.index')" :active="request()->routeIs('volunteer-statuses.*')">Volunteer Statuses</x-dropdown-link>
        </div>
    </div>
</div>
