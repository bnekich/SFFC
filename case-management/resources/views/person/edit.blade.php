@extends('layouts.app')

@section('header')
    <div class="row g3">
        <h3>Edit {{ $person->first_name }} {{ $person->last_name }}</h3>
    </div>
@endsection

@section('content')
    <div class="container">
        <form class="row g-3 align-items-center" action="{{ route('person.update', $person) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="col-auto">
                <input type="text" name="first_name" placeholder="First Name"
                    class="form-control-sm @error('first_name') is-invalid @enderror"
                    value="{{ old('first_name', $person->first_name) }}">
                @error('first_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-auto">
                <input type="text" name="middle_name" placeholder="Middle Name"
                    class="form-control-sm @error('middle_name') is-invalid @enderror"
                    value="{{ old('middle_name', $person->middle_name) }}">
                @error('middle_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-auto">
                <input type="text" name="last_name" placeholder="Last Name"
                    class="form-control-sm @error('last_name') is-invalid @enderror"
                    value="{{ old('last_name', $person->last_name) }}">
                @error('last_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-auto">
                <input type="email" name="email" placeholder="Email"
                    class="form-control-sm @error('email') is-invalid @enderror" value="{{ old('email', $person->email) }}">
                @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-auto">
                <input type="text" name="phone" placeholder="Phone"
                    class="phone-input form-control-sm @error('phone') is-invalid @enderror"
                    value="{{ old('phone', $person->phone) }}">
                @error('phone')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <label class="form-label">Date of Birth</label>
                    <input type="date" name="date_of_birth"
                        class="form-control-sm @error('date_of_birth') is-invalid @enderror"
                        value="{{ old('date_of_birth', $person->date_of_birth) }}">
                    @error('date_of_birth')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-auto">
                    <label class="form-label">Gender</label>
                    <select name="gender" class="form-select-sm @error('gender') is-invalid @enderror">
                        <option value="">(Select One)</option>
                        @foreach ($genders as $gender)
                            <option value="{{ $gender->value }}"
                                {{ $gender->value === $person->gender ? 'selected' : '' }}>
                                {{ $gender->name }}</option>
                        @endforeach
                    </select>
                    @error('gender')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-auto form-check">
                    <input type="checkbox" name="can_text_reminder" value="1" class="form-check-input"
                        {{ old('can_text_reminder', $person->can_text_reminder) ? 'checked' : '' }}>
                    <label class="form-check-label">Can Text Reminder</label>
                </div>
                <div class="col-auto form-check">
                    <input type="checkbox" name="can_email_reminder" value="1" class="form-check-input"
                        {{ old('can_email_reminder', $person->can_email_reminder) ? 'checked' : '' }}>
                    <label class="form-check-label">Can Email Reminder</label>
                </div>
            </div>
            <x-address-form :address="$person->address" :states="$states" />
            <div class="col-6">
                <label class="form-label">Family Connections</label>
                <select class="family-select form-select" name="family_ids[]" multiple>
                    @foreach ($person->families as $family)
                        <option value="{{ $family->id }}" selected>{{ $family->family_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6">
                <label class="form-label">Organizations</label>
                <select class="org-select form-select" name="org_ids[]" multiple>
                    @foreach ($person->organizations as $organization)
                        <option value="{{ $organization->id }}" selected>{{ $organization->name }}</option>
                    @endforeach
                </select>
            </div>

            @canany(['users-create', 'users-edit'])
                <div class="col-auto" id="authRolesSection" style="display: {{ $person->user ? 'block' : 'none' }};">
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
                                            data-role="{{ $role->name }}" data-roletype="authorization"
                                            {{ $person->user->hasRole($role->name) ? 'checked' : '' }}>
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
                {{-- </div> --}}
            @endcanany
            <div class="row g-3">
                <div class="col-auto">
                    @canany('[user-create, user-edit]')
                        <button type="submit" class="btn btn-primary mt-3">Update</button>
                    @endcanany
                    @can('users-delete')
                        <a href="{{ route('person.index') }}" class="btn btn-secondary mt-3">Cancel</a>
                    @endcan
                </div>
            </div>
        </form>
    </div>
@endsection
