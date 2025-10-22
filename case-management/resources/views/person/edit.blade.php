@extends('layouts.app')

@section('header')
    Edit {{ $person->first_name }} {{ $person->last_name }}
@endsection

@section('content')
    <div class="container mx-auto p-4">
        <form class="space-y-6" action="{{ route('person.update', $person) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="first_name" class="sffc-label">First Name</label>
                    <input id="first_name" type="text" name="first_name" placeholder="First Name"
                        class="sffc-text-input @error('first_name') border-red-500 @enderror"
                        value="{{ old('first_name', $person->first_name) }}">
                    @error('first_name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="middle_name" class="sffc-label">Middle Name</label>
                    <input id="middle_name" type="text" name="middle_name" placeholder="Middle Name"
                        class="sffc-text-input @error('middle_name') border-red-500 @enderror"
                        value="{{ old('middle_name', $person->middle_name) }}">
                    @error('middle_name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="last_name" class="sffc-label">Last Name</label>
                    <input id="last_name" type="text" name="last_name" placeholder="Last Name"
                        class="sffc-text-input @error('last_name') border-red-500 @enderror"
                        value="{{ old('last_name', $person->last_name) }}">
                    @error('last_name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="email" class="sffc-label">Email</label>
                    <input id="email" type="email" name="email" placeholder="Email"
                        class="sffc-text-input @error('email') border-red-500 @enderror"
                        value="{{ old('email', $person->email) }}">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="phone" class="sffc-label">Phone</label>
                    <input id="phone" type="text" name="phone" placeholder="Phone"
                        class="phone-input sffc-text-input @error('phone') border-red-500 @enderror"
                        value="{{ old('phone', $person->phone) }}">
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
                        value="{{ old('date_of_birth', $person->date_of_birth ? \Carbon\Carbon::parse($person->date_of_birth)->format('Y-m-d') : '') }}">
                    @error('date_of_birth')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="gender" class="sffc-label">Gender</label>
                    <select id="gender" name="gender" class="sffc-text-input @error('gender') border-red-500 @enderror">
                        <option value="">(Select One)</option>
                        @foreach ($genders as $gender)
                            <option value="{{ $gender->value }}"
                                {{ old('gender', $person->gender) == $gender->value ? 'selected' : '' }}>
                                {{ $gender->name }}</option>
                        @endforeach
                    </select>
                    @error('gender')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="space-y-4">
                <div class="flex items-center">
                    <input id="can_text_reminder" type="checkbox" name="can_text_reminder" value="1"
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                        {{ old('can_text_reminder', $person->can_text_reminder) ? 'checked' : '' }}>
                    <label for="can_text_reminder" class="ml-2 block text-sm text-gray-900">Can Receive Text
                        Reminders</label>
                </div>
                <div class="flex items-center">
                    <input id="can_email_reminder" type="checkbox" name="can_email_reminder" value="1"
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                        {{ old('can_email_reminder', $person->can_email_reminder) ? 'checked' : '' }}>
                    <label for="can_email_reminder" class="ml-2 block text-sm text-gray-900">Can Receive Email
                        Reminders</label>
                </div>
            </div>

            <x-address-form :address="$person->address" :states="$states" />
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-choices-select id="family_ids" name="family_ids[]" label="Family Connections" url="/familySearch"
                    multiple="true" placeholder="Search for families..." labelKey="family_name" :options="$person->families"
                    :selected="$person->families->pluck('id')->toArray()" />

                <x-choices-select id="org_ids" name="org_ids[]" label="Organization Connections" url="/orgSearch"
                    multiple="true" placeholder="Search for Organizations..." labelKey="name" :options="$person->organizations"
                    :selected="$person->organizations->pluck('id')->toArray()" />
            </div>
            <div class="flex items-center gap-4">
                @canany(['user-create', 'user-edit'])
                    <button type="submit" class="sffc-btn-primary">Update</button>
                @endcanany
                <a href="{{ route('person.index') }}" class="sffc-btn-cancel">Cancel</a>
            </div>

        </form>
    </div>
@endsection
