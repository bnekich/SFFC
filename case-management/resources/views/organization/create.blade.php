@extends('layouts.app')

@section('title')
    - Add Organization
@endsection

@section('content')
@section('header')
    Add Organization
@endsection
<form class="space-y-6" action="{{ route('organization.store') }}" method="POST">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <label for="name" class="sffc-label">Organization Name<span class=" text-red-500">*</span></label>
            <input type="text" name="name" id="name" placeholder="Organization Name"
                class="sffc-text-input @error('name') border-red-500 @enderror" value="{{ old('name') }}" required>
            @error('name')
                <span class="sffc-text-input-error">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="organization_status_id" class="sffc-label">Status<span class=" text-red-500">*</span></label>
            <select name="organization_status_id" {{-- class="sffc-text-input @error('organization_type_id') border-red-500 @enderror" required> --}}
                class="sffc-text-input @error('organization_status_id') border-red-500 @enderror">
                <option value="">(Select}</option>
                @foreach ($orgStatuses as $orgStatus)
                    <option value="{{ $orgStatus->id }}"
                        {{ old('organization_status_id') == $orgStatus->id ? 'selected' : '' }}>
                        {{ $orgStatus->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="organization_type_id" class="sffc-label">Type<span class=" text-red-500">*</span></label>
            <select name="organization_type_id"
                class="sffc-text-input @error('organization_type_id') border-red-500 @enderror" required>
                <option value="">(Select)</option>
                @foreach ($orgTypes as $orgType)
                    <option value="{{ $orgType->id }}"
                        {{ old('organization_type_id') == $orgType->id ? 'selected' : '' }}>
                        {{ $orgType->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="flex items-center col-span-full space-x-2">
            <input class="sffc-checkbox" type="checkbox" name="is_referring_agency" id="is_referring_agency"
                value="1">
            <label class="sffc-label" for="is_referring_agency">Is Referring Agency </label>
            <input class="sffc-checkbox" type="checkbox" name="is_community_partner" id="is_community_partner"
                value="1">
            <label class="sffc-label" for="is_community_partner">Is Community Partner </label>
        </div>
        <div class="col-span-full">
            <x-address-form :address="$address" :states="$states" />
        </div>
        <div>
            <label for="contact_person_name" class="sffc-label">Contact Person Name<span
                    class=" text-red-500">*</span></label>
            <input type="text" name="contact_person_name" id="contact_person_name" placeholder="Contact Person Name"
                class="sffc-text-input @error('contact_person_name') border-red-500 @enderror"
                value="{{ old('contact_person_name') }}">
            @error('contact_person_name')
                <span class="sffc-text-input-error">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="contact_person_title" class="sffc-label">Contact Person Title<span
                    class=" text-red-500">*</span></label>
            <input type="text" name="contact_person_title" id="contact_person_title"
                placeholder="Contact Person Title"
                class="sffc-text-input @error('contact_person_title') border-red-500 @enderror"
                value="{{ old('contact_person_title') }}">
            @error('contact_person_title')
                <span class="sffc-text-input-error">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="contact_person_email" class="sffc-label">Contact Person Email<span
                    class=" text-red-500">*</span></label>
            <input type="text" name="contact_person_email" id="contact_person_email"
                placeholder="Contact Person Email"
                class="email-input sffc-text-input @error('contact_person_email') border-red-500 @enderror"
                value="{{ old('contact_person_email') }}">
            @error('contact_person_email')
                <span class="sffc-text-input-error">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="contact_person_phone" class="sffc-label">Contact Person Phone<span
                    class=" text-red-500">*</span></label>
            <input type="text" name="contact_person_phone" id="contact_person_phone"
                placeholder="Contact Person Phone"
                class="phone-input sffc-text-input @error('contact_person_phone') border-red-500 @enderror"
                value="{{ old('contact_person_phone') }}">
            @error('contact_person_phone')
                <span class="sffc-text-input-error">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="contact_person_mobile" class="sffc-label">Contact Person Mobile Phone<span
                    class=" text-red-500">*</span></label>
            <input type="text" name="contact_person_mobile" id="contact_person_mobile"
                placeholder="Contact Person Mobile Phone"
                class="phone-input sffc-text-input @error('contact_person_mobile') border-red-500 @enderror"
                value="{{ old('contact_person_mobile') }}">
            @error('contact_person_mobile')
                <span class="sffc-text-input-error">{{ $message }}</span>
            @enderror
        </div>

        <x-choices-select id="persons" name="person_ids[]" label="Attach People" url="/peopleSearch" multiple="true"
            placeholder="Search for People..." labelKey="name" />

        {{-- <div class="col-span-full">
            <label class="sffc-label">Associated People</label>
            <select class="form-select person-select" name="person_ids[]" multiple></select>
        </div> --}}

        <div class="col-span-full">
            <button type="submit" class="sffc-btn-primary">Create Organization</button>
            <a href="{{ route('organization.index') }}" class="sffc-btn-cancel">Cancel</a>
        </div>
    </div>
</form>
@endsection
