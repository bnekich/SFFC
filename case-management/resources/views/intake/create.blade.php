@extends('layouts.app')

@section('content')
    <div class="container">
    @section('header')
        <div class="row g3">
            <h3>Add Intake</h3>
        </div>
    @endsection
    <form class="row g-3 align-items-center" action="{{ route('intake.store') }}" method="POST">
        @csrf
        <div class="col-auto">
            <input type="text" name="parent_name" placeholder="Parent Name"
                class="form-control-sm @error('parent_name') is-invalid @enderror" value="{{ old('parent_name') }}"
                required>
            @error('parent_name')
                <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-auto">
            <input type="text" name="parent_phone" placeholder="Parent Phone Number"
                class="form-control-sm phone-input form-control @error('parent_phone') is-invalid @enderror"
                value="{{ old('parent_phone') }}" required>
            @error('parent_phone')
                <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-auto">
            <label class="form-label">Referral Date</label>
            <input type="date" name="referral_date"
                class="form-control-sm @error('referral_date') is-invalid @enderror"
                value="{{ old('referral_date', \Carbon\Carbon::now()->format('Y-m-d')) }}" required>
            @error('referral_date')
                <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-auto">
            <div class="form-check form-switch">
                <input type="checkbox" name="hasSFFCHistory" value="1" class="form-check-input"
                    {{ old('hasSFFCHistory') ? 'checked' : '' }}>
                <label class="form-check-label">Has SFFC History?</label>
            </div>
            <div class="form-check form-switch">
                <input type="checkbox" name="requesting_host_family" value="1" class="form-check-input"
                    {{ old('requesting_host_family') ? 'checked' : '' }}>
                <label class="form-check-label">Requesting Host Family</label>
            </div>
            <div class="form-check form-switch">
                <input type="checkbox" name="requesting_family_friend" value="1" class="form-check-input"
                    {{ old('requesting_family_friend') ? 'checked' : '' }}>
                <label class="form-check-label">Requesting Family Friend</label>
            </div>
            <div class="form-check form-switch">
                <input type="checkbox" name="requesting_resource_friend" value="1" class="form-check-input"
                    {{ old('requesting_resource_friend') ? 'checked' : '' }}>
                <label class="form-check-label">Requesting Resource Friend</label>
            </div>
        </div>
        <div class="form-group">
            <textarea name="referral_contact" class="form-control  @error('referral_contact') is-invalid @enderror"
                placeholder="Referral Contact Information (Name, phone, email, etc.)"></textarea>
            @error('referral_contact')
                <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <textarea name="case_summary" class="form-control" placeholder="Reason for Referral / Case Summary"></textarea>
        </div>
        <div class="row g-3">
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mt-3">Save</button>
                <a href="{{ route('intake.index') }}" class="btn btn-secondary mt-3">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
