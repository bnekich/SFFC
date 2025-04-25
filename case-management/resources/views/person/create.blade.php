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
                class="phone-input form-control-sm @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
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
                        <option value="{{ $gender->value }}" {{ old('gender') == $gender->value ? 'selected' : '' }}>
                            {{ $gender->value }}
                        </option>
                    @endforeach
                </select>
                @error('gender')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-auto">
                <label class="form-label">Ethnicity</label>
                <select name="ethnicity" class="form-select-sm @error('ethnicity') is-invalid @enderror">
                    <option value=""> (Select)</option>
                    @foreach ($ethnicities as $ethnicity)
                        <option value="{{ $ethnicity->value }}"
                            {{ old('ethnicity') == $ethnicity->value ? 'selected' : '' }}>
                            {{ $ethnicity->label() }}
                        </option>
                    @endforeach
                </select>
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
        <div class="row g-3 align-items-center">
            <div class="col-6">
                <label class="form-label">Family Connections</label>
                <select class="family-select form-select" name="family_ids[]" multiple></select>
            </div>
            <div class="col-6">
                <label class="form-label">Organizations</label>
                <select class="org-select form-select" name="org_ids[]" multiple></select>
            </div>
        </div>
        @can('users-create')
            <div class="row g-3 align-items-center">
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
        <div class="modal fade" id="createOrganizationModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create New Organization</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="error-messages" class="alert alert-danger" style="display:none;"></div>
                        <form id="create-organization-form" action="{{ route('organization.store') }}"
                            method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <!-- Add other organization fields as needed -->
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
