@extends('layouts.app')
{{-- Add this to resources/views/person/create.blade.php --}}
@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
        <h4 class="font-bold">Please correct the following errors:</h4>
        <ul class="list-disc list-inside mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@section('title')
    - Add Person
@endsection

@section('content')
    <div class="container mx-auto p-4">
    @section('header')
        <div class="mb-4">
            <h3 class="text-2xl font-bold">Add Person</h3>
        </div>
    @endsection
    <form class="space-y-6" action="{{ route('person.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label for="first_name" class="block text-sm font-medium text-gray-700 label-required">First
                    Name</label>
                <input id="first_name" type="text" name="first_name" placeholder="First Name"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('first_name') is-invalid @enderror"
                    value="{{ old('first_name') }}" required>
                @error('first_name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="middle_name" class="block text-sm font-medium text-gray-700">Middle Name</label>
                <input id="middle_name" type="text" name="middle_name" placeholder="Middle Name"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('middle_name') is-invalid @enderror"
                    value="{{ old('middle_name') }}">
                @error('middle_name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="last_name" class="block text-sm font-medium text-gray-700 label-required">Last Name</label>
                <input id="last_name" type="text" name="last_name" placeholder="Last Name"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('last_name') is-invalid @enderror"
                    value="{{ old('last_name') }}" required>
                @error('last_name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 label-required">Email</label>
                <input id="email" type="email" name="email" placeholder="Email"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" required>
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 label-required">Phone
                    Number</label>
                <input id="phone" type="text" name="phone" placeholder="Phone Number"
                    class="phone-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('phone') is-invalid @enderror"
                    value="{{ old('phone') }}" required>
                @error('phone')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                <input id="date_of_birth" type="date" name="date_of_birth"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('date_of_birth') is-invalid @enderror"
                    value="{{ old('date_of_birth') }}">
                @error('date_of_birth')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                <select id="gender" name="gender"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('gender') is-invalid @enderror">
                    <option value=""> (Select)</option>
                    @foreach ($genders as $gender)
                        <option value="{{ $gender->value }}" {{ old('gender') == $gender->value ? 'selected' : '' }}>
                            {{ $gender->value }}
                        </option>
                    @endforeach
                </select>
                @error('gender')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="ethnicity" class="block text-sm font-medium text-gray-700">Ethnicity</label>
                <select id="ethnicity" name="ethnicity"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('ethnicity') is-invalid @enderror">
                    <option value=""> (Select)</option>
                    @foreach ($ethnicities as $ethnicity)
                        <option value="{{ $ethnicity->value }}"
                            {{ old('ethnicity') == $ethnicity->value ? 'selected' : '' }}>
                            {{ $ethnicity->label() }}
                        </option>
                    @endforeach
                </select>
                @error('ethnicity')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="flex items-center">
            <input id="can_text_reminder" type="checkbox" name="can_text_reminder" value="1"
                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                {{ old('can_text_reminder') ? 'checked' : '' }}>
            <label for="can_text_reminder" class="ml-2 block text-sm text-gray-900">Can Receive Text Reminders</label>
        </div>
        <div class="flex items-center">
            <input id="can_email_reminder" type="checkbox" name="can_email_reminder" value="1"
                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                {{ old('can_email_reminder') ? 'checked' : '' }}>
            <label for="can_email_reminder" class="ml-2 block text-sm text-gray-900">Can Receive Email Reminders</label>
        </div>
        <x-address-form :address="$address" :states="$states" />
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="family_ids" class="block text-sm font-medium text-gray-700">Family Connections</label>
                <select id="family_ids"
                    class="family-select mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    name="family_ids[]" multiple></select>
            </div>
            <div>
                <label for="org_ids" class="block text-sm font-medium text-gray-700">Organizations</label>
                <select id="org_ids"
                    class="org-select mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    name="org_ids[]" multiple></select>
            </div>
        </div>
        @can('users-create')
            <div class="flex items-center">
                <div class="flex items-center">
                    <input class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" type="checkbox"
                        name="isSystemUser" id="isSystemUser" value="1">
                    <label class="ml-2 block text-sm text-gray-900" for="isSystemUser">Add as a Case Management
                        User</label>
                </div>
            </div>
        @endcan
        <!-- Authorization Roles (Conditional) -->
        <div id="authRolesSection" style="display: none;">
            <div class="relative inline-block text-left" x-data="{ open: false }">
                <button @click="open = !open" type="button"
                    class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    id="authorizationRoleDropDown" data-bs-toggle="dropdown" aria-expanded="false">
                    Select Roles
                    <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
                <ul x-show="open" @click.away="open = false"
                    class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none p-2"
                    aria-labelledby="authorizationRoleDropDown" style="display: none;">
                    @foreach ($allRoles as $role)
                        <li class="flex items-center p-2">
                            <input class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                type="checkbox" name="auth_roles[]" value="{{ $role->id }}"
                                id="role_{{ $role->id }}" data-role="{{ $role->name }}">
                            <label for="role_{{ $role->id }}"
                                class="ml-2 text-sm text-gray-700">{{ $role->name }}</label>
                        </li>
                    @endforeach
                </ul>
            </div>
            @error('auth_roles')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex items-center gap-4">
            <button type="submit"
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
            <a href="{{ route('person.index') }}"
                class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</a>
        </div>
    </form>

    <div x-data="{ open: false }" class="flex justify-center">
        <!-- Trigger -->
        <span x-on:click="open = true">
            <button type="button"
                class="relative flex items-center justify-center gap-2 whitespace-nowrap rounded-lg border border-gray-200 bg-white px-4 py-2 text-gray-800 shadow-sm hover:border-gray-200 hover:bg-gray-50">
                Open modal
            </button>
        </span>

        <!-- Modal -->
        <div x-show="open" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog"
            aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')"
            class="fixed inset-0 z-10 overflow-y-auto">
            <!-- Overlay -->
            <div x-show="open" x-transition.opacity class="fixed inset-0 bg-black/25"></div>

            <!-- Panel -->
            <div x-show="open" x-transition x-on:click="open = false"
                class="relative flex min-h-screen items-center justify-center p-4">
                <div x-on:click.stop x-trap.noscroll.inert="open"
                    class="relative min-w-96 max-w-xl rounded-xl bg-white p-6 shadow-lg">
                    <!-- Title -->
                    <h2 class="font-medium text-gray-800" :id="$id('modal-title')">Confirm</h2>

                    <!-- Content -->
                    <p class="mt-2 text-gray-500 max-w-xs">Are you sure you want to learn how to create an awesome
                        modal?</p>

                    <!-- Buttons -->
                    <div class="mt-6 flex justify-end space-x-2">
                        <button type="button" x-on:click="open = false"
                            class="relative flex items-center justify-center gap-2 whitespace-nowrap rounded-lg border border-transparent bg-transparent px-4 py-2 text-gray-800 hover:bg-gray-800/10">
                            Cancel
                        </button>

                        <button type="button" x-on:click="open = false"
                            class="relative flex items-center justify-center gap-2 whitespace-nowrap rounded-lg border border-transparent bg-gray-800 px-4 py-2 text-white hover:bg-gray-900">
                            Confirm
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
