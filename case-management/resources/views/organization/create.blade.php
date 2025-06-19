@extends('layouts.app')

@section('title')
    - Add Organization
@endsection

@section('content')
    <div class="container">
    @section('header')
        <div class="row g3">
            <h3>Add Organization</h3>
        </div>
    @endsection
    <form class="row g-3 align-items-center" action="{{ route('organization.store') }}" method="POST">
        @csrf
        <div class="col-auto">
            <label for="name" class="form-label label-required">Organization Name</label>
            <input type="text" name="name" id="name" placeholder="Organization Name"
                class="form-control-sm @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-auto">
            <label for="organization_type_id" class="form-label label-required">Type</label>
            <select name="organization_type_id"
                class="form-select-sm @error('organization_type_id') is-invalid @enderror" required>
                <option value="">(Select)</option>
                @foreach ($orgTypes as $orgType)
                    <option value="{{ $orgType->id }}" {{ old('orgType_id') == $orgType->id ? 'selected' : '' }}>
                        {{ $orgType->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <x-address-form :address="$address" :states="$states" />

        <div class="col-auto">
            <label for="contact_person_name" class="form-label label-required">Contact Person Name</label>
            <input type="text" name="contact_person_name" id="contact_person_name" placeholder="Contact Person Name"
                class="form-control-sm @error('contact_person_name') is-invalid @enderror"
                value="{{ old('contact_person_name') }}">
            @error('contact_person_name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-auto">
            <label for="contact_person_title" class="form-label label-required">Contact Person Title</label>
            <input type="text" name="contact_person_title" id="contact_person_title"
                placeholder="Contact Person Title"
                class="form-control-sm @error('contact_person_title') is-invalid @enderror"
                value="{{ old('contact_person_title') }}">
            @error('contact_person_title')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-auto">
            <label for="contact_person_email" class="form-label label-required">Contact Person Email</label>
            <input type="text" name="contact_person_email" id="contact_person_email"
                placeholder="Contact Person Email"
                class="email-input form-control-sm @error('contact_person_email') is-invalid @enderror"
                value="{{ old('contact_person_email') }}">
            @error('contact_person_email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-auto">
            <label for="contact_person_phone" class="form-label label-required">Contact Person Phone</label>
            <input type="text" name="contact_person_phone" id="contact_person_phone"
                placeholder="Contact Person Phone"
                class="phone-input form-control-sm @error('contact_person_phone') is-invalid @enderror"
                value="{{ old('contact_person_phone') }}">
            @error('contact_person_phone')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-auto">
            <label for="contact_person_mobile" class="form-label label-required">Contact Person Mobile Phone</label>
            <input type="text" name="contact_person_mobile" id="contact_person_mobile"
                placeholder="Contact Person Mobile Phone"
                class="phone-input form-control-sm @error('contact_person_mobile') is-invalid @enderror"
                value="{{ old('contact_person_mobile') }}">
            @error('contact_person_mobile')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="row g-3">
            <div class="col-12">
                <label for="notes" class="form-label">Notes</label>
                <input type="textarea" name="notes" id="notes" placeholder="Notes"
                    class="form-control @error('notes') is-invalid @enderror" value="{{ old('notes') }}">
                @error('notes')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-6">
                <label class="form-label">Associated People</label>
                <select class="form-select person-select" name="person_ids[]" multiple></select>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Create Organization</button>
                <a href="{{ route('organization.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
