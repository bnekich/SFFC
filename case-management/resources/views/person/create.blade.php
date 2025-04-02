@extends('layouts.app')

@section('content')
    <div class="container">
    @section('header')
        <div class="row g3">
            <h3>Add Person</h3>
        </div>
    @endsection
    <form class="row g-3 align-items-center" action="{{ route('person.store') }}" method="POST">
        @csrf
        <div class="col-auto">
            <input type="text" name="first_name" placeholder="First Name"
                class="form-control-sm @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}">
            @error('first_name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-auto">
            <input type="text" name="middle_name" placeholder="Middle Name"
                class="form-control-sm  @error('middle_name') is-invalid @enderror" value="{{ old('middle_name') }}">
            @error('middle_name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-auto">
            <input type="text" name="last_name" placeholder="Last Name"
                class="form-control-sm @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}">
            @error('last_name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-auto">
            <input type="email" name="email" placeholder="Email"
                class="form-control-sm @error('email') is-invalid @enderror" value="{{ old('email') }}">
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-auto">
            <input type="text" name="phone" placeholder="Phone Number"
                class="form-control-sm @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
            @error('phone')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label class="form-label">Date of Birth</label>
                <input type="date" name="date_of_birth"
                    class="form-control-sm @error('date_of_birth') is-invalid @enderror"
                    value="{{ old('date_of_birth') }}">
                @error('date_of_birth')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-auto">
                <label class="form-label">Gender</label>
                <select name="gender" class="form-select-sm @error('gender') is-invalid @enderror">
                    <option value=""> (Select)</option>
                    @foreach ($genders as $gender)
                        <option value="{{ $gender->value }}">{{ $gender->name }}</option>
                        {{-- {{ old('gender') == '{{ $gender->value ?> ?>' }}'
                            ? 'selected' : '' }} --}}
                    @endforeach
                </select>
                @error('gender')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-check form-switch">
            <input type="checkbox" name="can_text_reminder" value="1" class="form-check-input"
                {{ old('can_text_reminder') ? 'checked' : '' }}>
            <label class="form-check-label">Can Receive Text Reminders</label>
        </div>
        <div class="form-switch form-check">
            <input type="checkbox" name="can_email_reminder" value="1" class="form-check-input"
                {{ old('can_email_reminder') ? 'checked' : '' }}>
            <label class="form-check-label">Can Receive Email Reminders</label>
        </div>
        <x-address-form :address="$address" :states="$states" />
        <select class="family-select" name="family_ids[]" multiple></select>
        @can('users-create')
            <div class="row g-3">
                <div class="col-auto">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="isSystemUser" id="isSystemUser"
                            value="1">
                        <label class="form-check-label" for="isSystemUser">Add as a Case Management User</label>
                    </div>
                </div>
            </div>
        @endcan
        <!-- Authorization Roles (Conditional) -->
        <div class="col-auto" id="authRolesSection" style="display: none;">
            <div class="dropdown">
                <button class="btn btn-success dropdown-toggle" type="button" id="authorizationRoleDropDown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Select Roles
                </button>
                <ul class="dropdown-menu" aria-labelledby="authorizationRoleDropDown">
                    @foreach ($allRoles as $role)
                        <div class="form-check form-switch">
                            <li>
                                <input class="form-check-input" type="checkbox" name="auth_roles[]"
                                    value="{{ $role->id }}" id="role_{{ $role->id }}"
                                    data-role="{{ $role->name }}">
                                <label for="role_{{ $role->id }}">{{ $role->name }}</label>
                            </li>
                        </div>
                    @endforeach
                </ul>
            </div>
            @error('auth_roles')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="row g-3">
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mt-3">Save</button>
                <a href="{{ route('person.index') }}" class="btn btn-secondary mt-3">Cancel</a>
            </div>
        </div>
    </form>
    @vite('resources/js/person-form.js')
</div>
@endsection
