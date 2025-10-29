@extends('layouts.app')

@section('title')
    - Edit Organization
@endsection

@section('header')
    Edit {{ $organization->name }}
@endsection

@section('content')
    <div class="container mx-auto p-4">
        <form class="space-y-6" action="{{ route('organization.update', $organization) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div>
                    <label for="name" class="sffc-label">Organization Name<span class=" text-red-500">*</span></label>
                    <input type="text" name="name" id="name" placeholder="Organization Name"
                        class="sffc-text-input @error('name') border-red-500 @enderror"
                        value="{{ old('name', $organization->name) }}" required>
                    @error('name')
                        <span class="sffc-text-input-error">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="organization_type_id" class="sffc-label">Type<span class=" text-red-500">*</span></label>
                    <select name="organization_type_id"
                        class="sffc-text-input @error('organization_type_id') border-red-500 @enderror" required>
                        <option value="">(Select)</option>
                        @foreach ($orgTypes as $orgType)
                            <option value="{{ $orgType->id }}"
                                {{ $orgType->id == $organization->organization_type_id ? 'selected' : '' }}>
                                {{ $orgType->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-full">
                    <x-address-form :address="$organization->address" :states="$states" />
                </div>
                <div>
                    <label for="contact_person_name" class="sffc-label">Contact Person Name</label>
                    <input type="text" name="contact_person_name" id="contact_person_name"
                        placeholder="Contact Person Name"
                        class="sffc-text-input @error('contact_person_name') border-red-500 @enderror"
                        value="{{ old('contact_person_name', $organization->contact_person_name) }}">
                    @error('contact_person_name')
                        <span class="sffc-text-input-error">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="contact_person_title" class="sffc-label">Contact Person Title</label>
                    <input type="text" name="contact_person_title" id="contact_person_title"
                        placeholder="Contact Person Title"
                        class="sffc-text-input @error('contact_person_title') border-red-500 @enderror"
                        value="{{ old('contact_person_title', $organization->contact_person_title) }}">
                    @error('contact_person_title')
                        <span class="sffc-text-input-error">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="contact_person_email" class="sffc-label">Contact Person Email</label>
                    <input type="text" name="contact_person_email" id="contact_person_email"
                        placeholder="Contact Person Email"
                        class="email-input sffc-text-input @error('contact_person_email') border-red-500 @enderror"
                        value="{{ old('contact_person_email', $organization->contact_person_email) }}">
                    @error('contact_person_email')
                        <span class="sffc-text-input-error">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="contact_person_phone" class="sffc-label">Contact Person Phone</label>
                    <input type="text" name="contact_person_phone" id="contact_person_phone"
                        placeholder="Contact Person Phone"
                        class="phone-input sffc-text-input @error('contact_person_phone') border-red-500 @enderror"
                        value="{{ old('contact_person_phone', $organization->contact_person_phone) }}">
                    @error('contact_person_phone')
                        <span class="sffc-text-input-error">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="contact_person_mobile" class="sffc-label">Contact Person Mobile Phone</label>
                    <input type="text" name="contact_person_mobile" id="contact_person_mobile"
                        placeholder="Contact Person Mobile Phone"
                        class="phone-input sffc-text-input @error('contact_person_mobile') border-red-500 @enderror"
                        value="{{ old('contact_person_mobile', $organization->contact_person_mobile) }}">
                    @error('contact_person_mobile')
                        <span class="sffc-text-input-error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-full">
                    <x-choices-select id="person_ids" name="person_ids[]" label="Associated People" url="/peopleSearch"
                        multiple="true" placeholder="Search for People..." labelKey="last_name" :options="$organization->persons"
                        :selected="$organization->persons->pluck('id')->toArray()" />
                </div>

                {{-- <div class="row g-3 align-items-center">
                    <div class="col-6">
                        <label class="form-label">Associated People</label>
                        <select class="person-select form-select" name="person_ids[]" multiple>
                            @foreach ($organization->persons as $person)
                                <option value="{{ $person->id }}" selected>
                                    {{ $person->last_name . ', ' . $person->first_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}
                <div class="row g-3">
                    <div>
                        <button type="submit" class="sffc-btn-primary">Update Organization</button>
                        <a href="{{ route('organization.index') }}" class="sffc-btn-cancel">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
