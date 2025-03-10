@extends('layouts.app') <!-- Assuming you have a layout file -->

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <h1 class="mb-4">Create User</h1>
                <button <!-- Success/Error Messages -->
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Create Form -->
                    <form method="POST" action="{{ route('users.store') }}" class="card p-4">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
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
                                                {{ old('roles') && in_array($role->name, old('roles')) ? 'checked' : '' }}>
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
                        <button type="submit" class="btn btn-primary">Create User</button>
                        <a href="{{ route('users') }}" class="btn btn-secondary">Cancel</a>
                    </form>
            </div>
        </div>
    </div>
@endsection
