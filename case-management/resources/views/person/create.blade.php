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
                    class="sffc-text-input @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}"
                    required>
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
        @can('user-create')
            <div class="flex items-center">
                <div class="flex items-center">
                    <input class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" type="checkbox"
                        name="isSystemUser" id="isSystemUser" value="1">
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
            <button type="submit"
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
            <a href="{{ route('person.index') }}"
                class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</a>
        </div>
    </form>
</div>
@endsection
