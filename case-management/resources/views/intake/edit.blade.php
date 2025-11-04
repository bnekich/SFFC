@extends('layouts.app')

@section('title')
    - Edit Intake
@endsection

@section('content')
    <div class="container">
    @section('header')
        Edit Intake for {{ $intake->first_name }} {{ $intake->last_name }}
    @endsection
    <form action="{{ route('intake.update', $intake->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-4 gap-6">
            <div class="col-span-2">
                <label class="sffc-label">Referral Date</label>
                <input type="text" name="referral_date" class="sffc-text-input"
                    value="{{ $intake->created_at->format('m/d/Y') }}" readonly>
            </div>
            <div class="col-span-2">
                <label class="sffc-label">Intake Status</label>
                <select name="intake_status_id" class="form-select-sm @error('intake_status') border-red-500 @enderror"
                    required>
                    @foreach ($intakeStatuses as $status)
                        <option value="{{ $status->id }}"
                            {{ $status->id === $intake->intake_status_id ? 'selected' : '' }}>
                            {{ $status->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-2">
                <input type="hidden" name="hasSFFCHistory" value="0">
                <input id="hasSFFCHistory" type="checkbox" name="hasSFFCHistory" value="1" class="sffc-checkbox"
                    {{ old('hasSFFCHistory', $intake->hasSFFCHistory) ? 'checked' : '' }}>
                <label for="hasSFFCHistory" class="sffc-checkbox-label m-2">Has SFFC History?</label>
            </div>
            <div class="col-span-2">
                <input type="hidden" name="requesting_resource_friend" value="0">
                <input id="requesting_resource_friend" type="checkbox" name="requesting_resource_friend" value="1"
                    class="sffc-checkbox"
                    {{ old('requesting_resource_friend', $intake->requesting_resource_friend) ? 'checked' : '' }}>
                <label for="requesting_resource_friend" class="sffc-checkbox-label m-2">Requesting Resource
                    Friend</label>
            </div>

            <div>
                <label for="first_name" class="sffc-label">First Name<span class=" text-red-500">*</span></label>
                <input id="first_name" type="text" name="first_name" placeholder="First Name"
                    class="sffc-text-input @error('first_name') border-red-500 @enderror"
                    value="{{ old('first_name', $intake->first_name) }}" required>
                @error('first_name')
                    <span class="sffc-text-input-error">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="last_name" class="sffc-label">Last Name<span class=" text-red-500">*</span></label>
                <input id="last_name" type="text" name="last_name" placeholder="Last Name"
                    class="sffc-text-input @error('last_name') border-red-500 @enderror"
                    value="{{ old('last_name', $intake->last_name) }}" required>
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
                            {{ old('ethnicity', $intake->ethnicity) == $ethnicity->value ? 'selected' : '' }}>
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
                        <option value="{{ $gender->value }}"
                            {{ old('gender', $intake->gender) == $gender->value ? 'selected' : '' }}>
                            {{ $gender->name }}</option>
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
                    value="{{ old('primary_language_spoken', $intake->primary_language_spoken) }}" required>
                @error('primary_language_spoken')
                    <span class="sffc-text-input-error">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="date_of_birth" class="sffc-label">Date of Birth<span class=" text-red-500">*</span></label>
                <input id="date_of_birth" type="date" name="date_of_birth" required
                    class="sffc-text-input @error('date_of_birth') border-red-500 @enderror"
                    value="{{ old('date_of_birth', $intake->date_of_birth) }}">
                @error('date_of_birth')
                    <p class="sffc-text-input-error">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="email" class="sffc-label">Email<span class=" text-red-500">*</span></label>
                <input id="email" type="email" name="email" placeholder="Email"
                    class=" sffc-text-input @error('email') border-red-500 @enderror"
                    value="{{ old('email', $intake->email) }}" required>
                @error('email')
                    <p class="sffc-text-input-error">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <input type="hidden" name="is_homeless" value="0">
                <input id="is_homeless" type="checkbox" name="is_homeless" value="0" class="sffc-checkbox"
                    {{ old('is_homeless', $intake->is_homeless) ? 'checked' : '' }}>
                <label for="is_homeless" class="sffc-checkbox-label m-2">Homeless?</label>
            </div>

            <div class="col-span-4">
                <x-address-form :address="$intake->address" :states="$states" />

            </div>
            <div>
                <label for="mobile_phone" class="sffc-label">Mobile Phone</label>
                <input id="mobile_phone" type="text" name="mobile_phone" placeholder="Parent Mobile Phone Number"
                    class="sffc-text-input phone-input  @error('mobile_phone') border-red-500 @enderror"
                    value="{{ old('mobile_phone', $intake->mobile_phone) }}" required>
                @error('mobile_phone')
                    <span class="sffc-text-input-error">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="other_phone class="sffc-label">Other Phone</label>
                <input id="other_phone" type="text" name="other_phone" placeholder="Parent other Phone Number"
                    class="sffc-text-input phone-input  @error('other_phone') border-red-500 @enderror"
                    value="{{ old('other_phone', $intake->other_phone) }}" required>
                @error('other_phone')
                    <span class="sffc-text-input-error">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex items-center">
                <input type="hidden" name="can_text_reminder" value="0">
                <input id="can_text_reminder" type="checkbox" name="can_text_reminder" value="0"
                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                    {{ old('can_text_reminder', $intake->can_text_reminder) ? 'checked' : '' }}>
                <label for="can_text_reminder" class="ml-2 block text-sm text-gray-900">Can Receive Text
                    Reminders</label>
            </div>
            <div class="flex items-center">
                <input type="hidden" name="can_email_reminder" value="0">
                <input id="can_email_reminder" type="checkbox" name="can_email_reminder" value="0"
                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                    {{ old('can_email_reminder', $intake->can_email_reminder) ? 'checked' : '' }}>
                <label for="can_email_reminder" class="ml-2 block text-sm text-gray-900">Can Receive Email
                    Reminders</label>
            </div>
            <div>
                <label for="organization_id" class="sffc-label">Safe Families Nearest You<span
                        class=" text-red-500">*</span></label>
                <select id="organization_id" name="organization_id"
                    class="sffc-text-input @error('gender') border-red-500 @enderror" required>
                    <option value=""> (Select)</option>
                    @foreach ($organizations as $organization)
                        <option value="{{ $organization->id }}"
                            {{ old('organization_id', $intake->organization_id) == $organization->id ? 'selected' : '' }}>
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
                            {{ old('organization_type_id', $intake->organization_type_id) == $orgType->id ? 'selected' : '' }}>
                            {{ $orgType->name }}
                        </option>
                    @endforeach
                </select>
                @error('organization_type_id')
                    <p class="sffc-text-input-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="number_of_children" class="sffc-label">Number of Children<span
                        class=" text-red-500">*</span></label>
                <input id="number_of_children" type="number" name="number_of_children" class="sffc-text-input"
                    value="{{ old('number_of_children', $intake->number_of_children) }}" required>
                @error('number_of_children')
                    <span class="sffc-text-input-error">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="urgency" class="sffc-label">Urgency of Assistance<span
                        class=" text-red-500">*</span></label>
                <select id="urgency" name="urgency" required
                    class="sffc-text-input @error('urgency') border-red-500 @enderror">
                    <option value=""> (Select)</option>
                    @foreach ($urgencies as $urgency)
                        <option value="{{ $urgency }}"
                            {{ old('urgency', $intake->urgency) == $urgency ? 'selected' : '' }}>
                            {{ $urgency }}
                        </option>
                    @endforeach
                </select>
                @error('urgency')
                    <p class="sffc-text-input-error">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-span-4">
                <label for="reason_for_assistance" class="sffc-label">Reason for Assisstance<span
                        class=" text-red-500">*</span></label>
                <textarea id="reason_for_assistance" name="reason_for_assistance" class="sffc-text-input" required>{{ old('reason_for_assistance', $intake->reason_for_assistance) }}</textarea>
                @error('reason_for_assistance')
                    <span class="sffc-text-input-error">{{ $message }}</span>
                @enderror
            </div>
            {{-- Start Radios --}}
            <div>
                <label class="sffc-label mb-2">
                    Has Parent Agreed to Safe Families Support? <span class="text-red-600">*</span>
                </label>
                {{-- <div class="flex flex-col space-y-3"> --}}
                <div>
                    {{-- <label class="flex items-center">
                        <input type="radio" name="requested_service" value="host"
                            {{ old('requested_service', $intake->requesting_host_family) === true ? 'checked' : '' }}
                            class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                        <span class="ml-2">Requesting Host Family</span>
                    </label> --}}

                    <label class="flex items-center">

                        <input type="radio" name="sffc_choice" value="declines"
                            {{ old('parent_declines_sffc_support', $intake->parent_declines_sffc_support) == true ? 'checked' : '' }}
                            class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                        <span class="ml-2">Declines SFFC support</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="sffc_choice" value="agrees"
                            {{ old('parent_accepts_sffc_support', $intake->parent_accepts_sffc_support) == true ? 'checked' : '' }}
                            class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                        <span class="ml-2">Agrees to SFFC support</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="sffc_choice" value="more_info"
                            {{ old('parent_wants_more_info', $intake->parent_wants_more_info) == true ? 'checked' : '' }}
                            class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                        <span class="ml-2">Wants more information</span>
                    </label>
                </div>
                @error('sffc_choice')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    SFFC Service Preference <span class="text-red-600">*</span>
                </label>
                <div class="flex flex-col space-y-3">
                    <label class="flex items-center">
                        <input type="radio" name="requested_service" value="host"
                            {{ old('requested_service', $intake->requesting_host_family) === true ? 'checked' : '' }}
                            class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                        <span class="ml-2">Requesting Host Family</span>
                    </label>

                    <label class="flex items-center">
                        <input type="radio" name="requested_service" value="friend"
                            {{ old('requested_service', $intake->requesting_family_friend) === true ? 'checked' : '' }}
                            class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                        <span class="ml-2">Requests Family Friend</span>
                    </label>
                </div>
            </div>

            {{-- end Radios --}}
            <div class=" col-span-4">
                <label class="sffc-label">Referring Organization</label>
                <div id="referral_organization" class="border border-gray-400 p-2 rounded-md">

                    <div>
                        <label for="referral_organization" class="sffc-label">Referring Organization</label>
                        <input id="referral_organization" type="text" name="referral_organization" placeholder=""
                            class="sffc-text-input @error('referral_organization') border-red-500 @enderror"
                            value="{{ old('referral_organization', $intake->referral_organization) }}">
                        @error('referral_organization')
                            <span class="sffc-text-input-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="referral_contact" class="sffc-label">Referring Organization</label>
                        <input id="referral_contact" type="text" name="referral_contact" placeholder=""
                            class="sffc-text-input @error('referral_contact') border-red-500 @enderror"
                            value="{{ old('referral_contact', $intake->referral_contact) }}">
                        @error('referral_contact')
                            <span class="sffc-text-input-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="referral_organization_phone" class="sffc-label">Referring Organization
                            Phone</label>
                        <input id="referral_organization_phone" type="text" name="referral_organization_phone"
                            placeholder=""
                            class="sffc-text-input phone-input @error('referral_organization_phone') border-red-500 @enderror"
                            value="{{ old('referral_organization_phone', $intake->referral_organization_phone) }}">
                        @error('referral_organization_phone')
                            <span class="sffc-text-input-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="referral_organization_email" class="sffc-label">Referring Organization
                            Email</label>
                        <input id="referral_organization_email" type="email" name="referral_organization_email"
                            placeholder=""
                            class="sffc-text-input  @error('referral_organization_email') border-red-500 @enderror"
                            value="{{ old('referral_organization_email', $intake->referral_organization_email) }}">
                        @error('referral_organization_email')
                            <span class="sffc-text-input-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

        </div>
        {{-- <div class="form-check form-switch">
                    <input type="hidden" name="requesting_host_family" value="0">
                    <input type="checkbox" name="requesting_host_family" value="1" class="form-check-input"
                        {{ old('requesting_host_family', $intake->requesting_host_family) ? 'checked' : '' }}>
                    <label class="form-check-label">Requesting Host Family</label>
                </div>
                <div class="form-check form-switch">
                    <input type="hidden" name="requesting_family_friend" value="0">
                    <input type="checkbox" name="requesting_family_friend" value="1" class="form-check-input"
                        {{ old('requesting_family_friend', $intake->requesting_family_friend) ? 'checked' : '' }}>
                    <label class="form-check-label">Requesting Family Friend</label>
                </div> --}}

        <div class="col-span-4">
            <button type="submit" class="sffc-btn-primary">Save</button>
            <a href="{{ route('intake.index') }}" class="sffc-btn-cancel">Cancel</a>
        </div>

    </form>
</div>
@endsection
