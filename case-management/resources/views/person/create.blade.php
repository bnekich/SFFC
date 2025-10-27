@extends('layouts.app')

@section('title')
    - Add Person
@endsection

@section('content')
@section('header')
    Add Person
@endsection
<form class="space-y-6" action="{{ route('person.store') }}" method="POST">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <label for="first_name" class="sffc-label">First Name<span class=" text-red-500">*</span></label>
            <input id="first_name" type="text" name="first_name" placeholder="First Name"
                class="sffc-text-input @error('first_name') border-red-500 @enderror" value="{{ old('first_name') }}"
                required>
            @error('first_name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="middle_name" class="sffc-label">Middle Name</label>
            <input id="middle_name" type="text" name="middle_name" placeholder="Middle Name"
                class="sffc-text-input @error('middle_name') border-red-500 @enderror" value="{{ old('middle_name') }}">
            @error('middle_name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="last_name" class="sffc-label">Last Name<span class=" text-red-500">*</span></label>
            <input id="last_name" type="text" name="last_name" placeholder="Last Name"
                class="sffc-text-input @error('last_name') border-red-500 @enderror" value="{{ old('last_name') }}"
                required>
            @error('last_name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="email" class="sffc-label">Email<span class=" text-red-500">*</span></label>
            <input id="email" type="email" name="email" placeholder="Email"
                class=" sffc-text-input @error('email') border-red-500 @enderror" value="{{ old('email') }}" required>
            @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="phone" class="sffc-label">Phone
                Number<span class=" text-red-500">*</span></label>
            <input id="phone" type="text" name="phone" placeholder="Phone Number"
                class="phone-input sffc-text-input @error('phone') border-red-500 @enderror" value="{{ old('phone') }}"
                required>
            @error('phone')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <label for="date_of_birth" class="sffc-label">Date of Birth</label>
            <input id="date_of_birth" type="date" name="date_of_birth"
                class="sffc-text-input @error('date_of_birth') border-red-500 @enderror"
                value="{{ old('date_of_birth') }}">
            @error('date_of_birth')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="gender" class="sffc-label">Gender</label>
            <select id="gender" name="gender" class="sffc-text-input @error('gender') border-red-500 @enderror">
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
            <label for="ethnicity" class="sffc-label">Ethnicity</label>
            <select id="ethnicity" name="ethnicity"
                class="sffc-text-input @error('ethnicity') border-red-500 @enderror">
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
        <label for="can_email_reminder" class="ml-2 block text-sm text-gray-900">Can Receive Email
            Reminders</label>
    </div>
    <x-address-form :address="$address" :states="$states" />


    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <x-choices-select id="family_ids" name="family_ids[]" label="Family Connections" url="/familySearch"
            multiple="true" placeholder="Search for families..." labelKey="family_name" />

        <x-choices-select id="org_ids" name="org_ids[]" label="Organization Connections" url="/orgSearch"
            multiple="true" placeholder="Search for Organizations..." labelKey="name" />
    </div>
    @can('user-create')
        <div class="flex items-center">
            <div class="flex items-center">
                <input class="sffc-checkbox" type="checkbox" name="isSystemUser" id="isSystemUser" value="1">
                <label class="ml-2 block text-sm text-gray-900" for="isSystemUser">Add This Person as a Case
                    Management
                    User or Volunteer</label>
            </div>
        </div>
    @endcan
    <!-- Authorization Roles (Conditional) -->
    <div id="authRolesSection" style="display: none;">
        <select id="personAuthRoles" name="auth_roles[]" multiple data-placeholder="Select Roles">
            @foreach ($authorizedRoles as $role)
                <option value="{{ $role->id }}" @selected(in_array($role->id, old('your_field_name', [])))>
                    {{ $role->name }}
                </option>
            @endforeach
        </select>

        @error('auth_roles')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    <div class="flex items-center gap-4">
        <button type="submit" class="sffc-btn-primary">Save</button>
        <a href="{{ route('person.index') }}" class="sffc-btn-cancel">Cancel</a>
    </div>
</form>
@endsection
