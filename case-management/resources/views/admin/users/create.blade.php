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
            <select id="userRoles" name="roles[]" multiple>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" @selected(in_array($role->id, old('your_field_name', [])))>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>

            @error('roles')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror

            <!-- Submit Button -->
            <button type="submit" class="sffc-btn-primary mt-2">Create User </button>
            <a href="{{ route('users.index') }}" class="sffc-btn-cancel mt-2">Cancel</a>
        </div>
    </form>
</div>
@endsection
