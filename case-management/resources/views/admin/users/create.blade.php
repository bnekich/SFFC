@extends('layouts.app')

@section('title')
    - Add User
@endsection

@section('content')

@section('header')
    <h3>Add User</h3>
@endsection

<div class="grid grid-cols-1 grid-rows-2 gap-4">
    <!-- Create Form -->
    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        <div>

            <label for="firstName" class="sffc-label">First Name<span class=" text-red-500">*</span></label>
            <input type="text" class="sffc-text-input mb-2 @error('firstName') is-invalid @enderror" id="firstName"
                name="firstName" value="{{ old('firstName') }}" required>
            @error('firstName')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <label for="lastName" class="sffc-label">Last Name<span class=" text-red-500">*</span></label>
            <input type="text" class="sffc-text-input mb-2 @error('lastName') is-invalid @enderror" id="lastName"
                name="lastName" value="{{ old('lastName') }}" required>
            @error('lastName')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <label for="email" class="sffc-label">{{ __('Email Address') }}<span
                    class=" text-red-500">*</span></label>
            <input id="email" type="email" name="email"
                class="sffc-text-input mb-2 @error('email') border-red-500 @enderror" value="{{ old('email') }}"
                required placeholder="Email">
            @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror


            <label for="phone" class="sffc-label">Phone Number<span class=" text-red-500">*</span></label>
            <input id="phone" type="text" name="phone" placeholder="Phone Number"
                class="phone-input mb-4 @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
            @error('phone')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="w-full">
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
                    @foreach ($roles as $role)
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
            <!-- Submit Button -->
            <button type="submit" class="sffc-btn-primary mt-2">Create User </button>
            <a href="{{ route('users.index') }}" class="sffc-btn-cancel mt-2">Cancel</a>
        </div>
    </form>
</div>
@endsection
