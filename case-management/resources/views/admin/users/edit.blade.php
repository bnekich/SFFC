@extends('layouts.app')

@section('header')
    <h3 class="text-2xl font-bold">Edit {{ $user->firstName }} {{ $user->lastName }}</h3>
@endsection

@section('content')
    <div class="container mx-auto p-4">
        <form method="POST" action="{{ route('users.update', $user) }}" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="firstName" class="sffc-label">First Name</label>
                    <input type="text" class="sffc-text-input @error('firstName') is-invalid @enderror" id="firstName"
                        name="firstName" value="{{ old('firstName', $user->firstName) }}" required>
                    @error('firstName')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- First Name -->
                <div class="mb-3">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control @error('lastName') is-invalid @enderror" id="lastName"
                        name="lastName" value="{{ old('lastName', $user->lastName) }}" required>
                    @error('lastName')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-auto">
                    <label for="phone" class="form-label label-required">Phone Number</label>
                    <input id="phone" type="text" name="phone" placeholder="Phone Number"
                        class="phone-input form-control-sm @error('phone') is-invalid @enderror" value="{{ old('phone') }}"
                        required>
                    @error('phone')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Roles -->
                <div class="mb-3">
                    <label class="form-label">Assign Roles</label>
                    <div class="row">
                        @foreach ($roles as $role)
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="roles[]"
                                        value="{{ $role->name }}" id="role-{{ $role->id }}"
                                        {{ $user->hasRole($role->name) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="role-{{ $role->id }}">
                                        {{ $role->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @error('roles')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Update User</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
