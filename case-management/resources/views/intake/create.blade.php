@extends('layouts.app')

@section('title')
    - Request Help
@endsection

@section('content')
@section('header')
    Please complete and submit the form below and someone from your area will contact you.
@endsection

<form class="space-y-6" action="{{ route('intake.store') }}" method="POST">
    @csrf
    <div class="grid grid-cols-4 gap-2">
        <div>
            <label for="first_name" class="sffc-label">First Name<span class=" text-red-500">*</span></label>
            <input id="first_name" type="text" name="first_name" placeholder="First Name"
                class="sffc-text-input @error('first_name') border-red-500 @enderror" value="{{ old('first_name') }}"
                required>
            @error('first_name')
                <span class="sffc-text-input-error">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="last_name" class="sffc-label">Last Name<span class=" text-red-500">*</span></label>
            <input id="last_name" type="text" name="last_name" placeholder="Last Name"
                class="sffc-text-input @error('last_name') border-red-500 @enderror" value="{{ old('last_name') }}"
                required>
            @error('last_name')
                <span class="sffc-text-input-error">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="ethnicity" class="sffc-label">Race/Ethnicity<span class=" text-red-500">*</span></label>
            <select id="ethnicity" name="ethnicity" required
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
                <p class="sffc-text-input-error">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="gender" class="sffc-label">Gender<span class=" text-red-500">*</span></label>
            <select id="gender" name="gender" class="sffc-text-input @error('gender') border-red-500 @enderror"
                required>
                <option value=""> (Select)</option>
                @foreach ($genders as $gender)
                    <option value="{{ $gender->value }}" {{ old('gender') == $gender->value ? 'selected' : '' }}>
                        {{ $gender->value }}
                    </option>
                @endforeach
            </select>
            @error('gender')
                <p class="sffc-text-input-error">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="primary_language_spoken" class="sffc-label">Primary Language Spoken<span
                    class=" text-red-500">*</span></label>
            <input id="primary_language_spoken" type="text" name="primary_language_spoken"
                placeholder="Exj: English, Spanish, Russian, etc."
                class="sffc-text-input @error('primary_language_spoken') border-red-500 @enderror"
                value="{{ old('primary_language_spoken') }}" required>
            @error('primary_language_spoken')
                <span class="sffc-text-input-error">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="date_of_birth" class="sffc-label">Date of Birth<span class=" text-red-500">*</span></label>
            <input id="date_of_birth" type="date" name="date_of_birth" required
                class="sffc-text-input @error('date_of_birth') border-red-500 @enderror"
                value="{{ old('date_of_birth') }}">
            @error('date_of_birth')
                <p class="sffc-text-input-error">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="email" class="sffc-label">Email<span class=" text-red-500">*</span></label>
            <input id="email" type="email" name="email" placeholder="Email"
                class=" sffc-text-input @error('email') border-red-500 @enderror" value="{{ old('email') }}" required>
            @error('email')
                <p class="sffc-text-input-error">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex items-center">
            <input type="hidden" name="is_homeless" value="0">
            <input id="is_homeless" type="checkbox" name="is_homeless" value="0" class="sffc-checkbox"
                {{ old('is_homeless') ? 'checked' : '' }}>
            <label for="is_homeless" class="sffc-checkbox-label m-2">Homeless?</label>
        </div>
        <div class="col-span-3">
            <x-address-form :address="$address" :states="$states" />
        </div>
        <div>
            <label for="mobile_phone" class="sffc-label">Mobile Phone</label>
            <input id="mobile_phone" type="text" name="mobile_phone" placeholder="Parent Mobile Phone Number"
                class="sffc-text-input phone-input  @error('mobile_phone') border-red-500 @enderror"
                value="{{ old('mobile_phone') }}" required>
            @error('mobile_phone')
                <span class="sffc-text-input-error">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="other_phone class="sffc-label">Other Phone</label>
            <input id="other_phone" type="text" name="other_phone" placeholder="Parent other Phone Number"
                class="sffc-text-input phone-input  @error('other_phone') border-red-500 @enderror"
                value="{{ old('other_phone') }}" required>
            @error('other_phone')
                <span class="sffc-text-input-error">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="organization_id" class="sffc-label">Safe Families Nearest You<span
                    class=" text-red-500">*</span></label>
            <select id="organization_id" name="organization_id"
                class="sffc-text-input @error('gender') border-red-500 @enderror" required>
                <option value=""> (Select)</option>
                @foreach ($organizations as $organization)
                    <option value="{{ $organization->id }}"
                        {{ old('organization_id') == $organization->id ? 'selected' : '' }}>
                        {{ $organization->name }}
                    </option>
                @endforeach
            </select>
            @error('organization_id')
                <p class="sffc-text-input-error">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="organization_type_id" class="sffc-label">How Did You Hear About Us?<span
                    class=" text-red-500">*</span></label>
            <select id="organization_type_id" name="organization_type_id"
                class="sffc-text-input @error('gender') border-red-500 @enderror" required>
                <option value=""> (Select)</option>
                @foreach ($orgTypes as $orgType)
                    <option value="{{ $orgType->id }}"
                        {{ old('organization_type_id') == $orgType->id ? 'selected' : '' }}>
                        {{ $orgType->name }}
                    </option>
                @endforeach
            </select>
            @error('organization_type_id')
                <p class="sffc-text-input-error">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="referral_organization" class="sffc-label">Referring Organization</label>
            <input id="referral_organization" type="text" name="referral_organization" placeholder=""
                class="sffc-text-input @error('referral_organization') border-red-500 @enderror"
                value="{{ old('referral_organization') }}">
            @error('referral_organization')
                <span class="sffc-text-input-error">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="referral_contact" class="sffc-label">Referring Organization</label>
            <input id="referral_contact" type="text" name="referral_contact" placeholder=""
                class="sffc-text-input @error('referral_contact') border-red-500 @enderror"
                value="{{ old('referral_contact') }}">
            @error('referral_contact')
                <span class="sffc-text-input-error">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="referral_organization_phone" class="sffc-label">Referring Organization Phone</label>
            <input id="referral_organization_phone" type="text" name="referral_organization_phone" placeholder=""
                class="sffc-text-input phone-input @error('referral_organization_phone') border-red-500 @enderror"
                value="{{ old('referral_organization_phone') }}">
            @error('referral_organization_phone')
                <span class="sffc-text-input-error">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="referral_organization_email" class="sffc-label">Referring Organization Email</label>
            <input id="referral_organization_email" type="email" name="referral_organization_email" placeholder=""
                class="sffc-text-input  @error('referral_organization_email') border-red-500 @enderror"
                value="{{ old('referral_organization_email') }}">
            @error('referral_organization_email')
                <span class="sffc-text-input-error">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-span-2">
            <label class="sffc-label mb-2">
                SFFC Support Preference <span class="text-red-600">*</span>
            </label>

            <div class="flex flex-col space-y-3">

                <label class="flex items-center">
                    <input type="radio" name="sffc_choice" value="declines"
                        {{ old('sffc_choice') === 'declines' ? 'checked' : '' }}
                        class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                    <span class="ml-2">Declines SFFC support</span>
                </label>

                <label class="flex items-center">
                    <input type="radio" name="sffc_choice" value="agrees"
                        {{ old('sffc_choice') === 'agrees' ? 'checked' : '' }}
                        class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                    <span class="ml-2">Agrees to SFFC support</span>
                </label>

                {{-- More Info --}}
                <label class="flex items-center">
                    <input type="radio" name="sffc_choice" value="more_info"
                        {{ old('sffc_choice') === 'more_info' ? 'checked' : '' }}
                        class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                    <span class="ml-2">Wants more information</span>
                </label>

            </div>

            @error('sffc_choice')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div class="col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                SFFC Service Preference <span class="text-red-600">*</span>
            </label>
            <div class="flex flex-col space-y-3">
                <label class="flex items-center">
                    <input type="radio" name="requested_service" value="host"
                        {{ old('requested_service') === 'host' ? 'checked' : '' }}
                        class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                    <span class="ml-2">Requesting Host Family</span>
                </label>

                <label class="flex items-center">
                    <input type="radio" name="requested_service" value="friend"
                        {{ old('requested_service') === 'friend' ? 'checked' : '' }}
                        class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                    <span class="ml-2">Requests Family Friend</span>
                </label>
            </div>
            <div class="col-span-4">
                <label for="reason_for_assistance" class="sffc-label">Reason for Assisstance<span
                        class=" text-red-500">*</span></label>
                <textarea id="reason_for_assistance" name="reason_for_assistance" class="sffc-text-input" required></textarea>
                @error('reason_for_assistance')
                    <span class="sffc-text-input-error">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-span-4">
                <label for="number_of_children" class="sffc-label">Number of Children<span
                        class=" text-red-500">*</span></label>
                <input id="number_of_children" type="number" name="number_of_children" class="sffc-text-input"
                    required>
                @error('number_of_children')
                    <span class="sffc-text-input-error">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex items-center">
                <input type="hidden" name="can_text_reminder" value="0">
                <input id="can_text_reminder" type="checkbox" name="can_text_reminder" value="0"
                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                    {{ old('can_text_reminder') ? 'checked' : '' }}>
                <label for="can_text_reminder" class="ml-2 block text-sm text-gray-900">Can Receive Text
                    Reminders</label>
            </div>
            <div class="flex items-center">
                <input type="hidden" name="can_email_reminder" value="0">
                <input id="can_email_reminder" type="checkbox" name="can_email_reminder" value="0"
                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                    {{ old('can_email_reminder') ? 'checked' : '' }}>
                <label for="can_email_reminder" class="ml-2 block text-sm text-gray-900">Can Receive Email
                    Reminders</label>
            </div>

            @auth
                <div>
                    <label class="sffc-label">Referral Date</label>
                    <input type="date" name="referral_date"
                        class="sffc-text-input @error('referral_date') border-red-500 @enderror"
                        value="{{ old('referral_date', \Carbon\Carbon::now()->format('Y-m-d')) }}" required>
                    @error('referral_date')
                        <span class="sffc-text-input-error">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <input type="hidden" name="intake_status_id" value="1">
                    <label class="sffc-label">Intake Status</label>
                    <select name="intake_status_id"
                        class="sffc-text-input @error('intake_status_id') border-red-500 @enderror" required>
                        {{-- <option value=""> (Select)</option> --}}
                        @foreach ($intakeStatuses as $status)
                            <option value="{{ $status->id }}"
                                {{ old('intake_status_id') == $status->id ? 'selected' : '' }}>
                                {{ $status->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <input type="hidden" name="hasSFFCHistory" value="0">
                    <input type="checkbox" name="hasSFFCHistory" value="1" class="sffc-checkbox"
                        {{ old('hasSFFCHistory') ? 'checked' : '' }}>
                    <label class="sffc-checkbox-label">Has SFFC History?</label>
                </div>
                <div>
                    <input type="hidden" name="requesting_resource_friend" value="0">
                    <input type="checkbox" name="requesting_resource_friend" value="1" class="sffc-checkbox"
                        {{ old('requesting_resource_friend') ? 'checked' : '' }}>
                    <label class="sffc-checkbox-label">Requesting Resource Friend</label>
                </div>
                <div>
                    <input type="hidden" name="do_not_share_list" value="0">
                    <input type="checkbox" name="do_not_share_list" value="1" class="sffc-checkbox"
                        {{ old('do_not_share_list') ? 'checked' : '' }}>
                    <label class="sffc-checkbox-label">Do Not Share List</label>
                </div>
            @endauth

            <button type="submit" class="btn btn-primary mt-3">Save</button>
            @auth
                <a href="{{ route('intake.index') }}" class="btn btn-secondary mt-3">Cancel</a>
            @else
                <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Cancel</a>
            @endauth
        </div>
</form>
@endsection
