@extends('layouts.app')

@section('title')
    - Add Intake
@endsection

@section('content')
    <div class="container">
    @section('header')
        <div class="row g3">
            <h3>Add Intake</h3>
        </div>
    @endsection

    <form class="row g-3 align-items-center" action="{{ route('intake.store') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-auto">
                <label class="form-label label-required">Parent Name</label>
                <input type="text" name="parent_name" placeholder="Parent Name"
                    class="form-control-sm @error('parent_name') is-invalid @enderror" value="{{ old('parent_name') }}"
                    required>
                @error('parent_name')
                    <span class="invalid-feedback d-block">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-auto">
                <label class="form-label label-required">Parent Phone</label>
                <input type="text" name="parent_phone" placeholder="Parent Phone Number"
                    class="form-control-sm phone-input  @error('parent_phone') is-invalid @enderror"
                    value="{{ old('parent_phone') }}" required>
                @error('parent_phone')
                    <span class="invalid-feedback d-block">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-auto">
                <label class="form-label label-required">Referral Date</label>
                <input type="date" name="referral_date"
                    class="form-control-sm @error('referral_date') is-invalid @enderror"
                    value="{{ old('referral_date', \Carbon\Carbon::now()->format('Y-m-d')) }}" required>
                @error('referral_date')
                    <span class="invalid-feedback d-block">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-auto">
                <label class="form-label label-required">Intake Status</label>
                <select name="intake_status" class="form-select-sm @error('intake_status') is-invalid @enderror"
                    required>
                    <option value=""> (Select)</option>
                    @foreach ($intakeStatuses as $status)
                        <option value="{{ $status->value }}"
                            {{ old('intake_status') == $status->value ? 'selected' : '' }}>
                            {{ $status->label() }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-auto">
                <div class="form-check form-switch">
                    <input type="hidden" name="hasSFFCHistory" value="0">
                    <input type="checkbox" name="hasSFFCHistory" value="1" class="form-check-input"
                        {{ old('hasSFFCHistory') ? 'checked' : '' }}>
                    <label class="form-check-label">Has SFFC History?</label>
                </div>
                <div class="form-check form-switch">
                    <input type="hidden" name="requesting_host_family" value="0">
                    <input type="checkbox" name="requesting_host_family" value="1" class="form-check-input"
                        {{ old('requesting_host_family') ? 'checked' : '' }}>
                    <label class="form-check-label">Requesting Host Family</label>
                </div>
                <div class="form-check form-switch">
                    <input type="hidden" name="requesting_family_friend" value="0">
                    <input type="checkbox" name="requesting_family_friend" value="1" class="form-check-input"
                        {{ old('requesting_family_friend') ? 'checked' : '' }}>
                    <label class="form-check-label">Requesting Family Friend</label>
                </div>
                <div class="form-check form-switch">
                    <input type="hidden" name="requesting_resource_friend" value="0">
                    <input type="checkbox" name="requesting_resource_friend" value="1" class="form-check-input"
                        {{ old('requesting_resource_friend') ? 'checked' : '' }}>
                    <label class="form-check-label">Requesting Resource Friend</label>
                </div>
                <div class="form-check form-switch">
                    <input type="hidden" name="do_not_share_list" value="0">
                    <input type="checkbox" name="do_not_share_list" value="1" class="form-check-input"
                        {{ old('do_not_share_list') ? 'checked' : '' }}>
                    <label class="form-check-label">Do Not Share List</label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label label-required">Referral Contact Information</label>
            <textarea name="referral_contact" class="form-control  @error('referral_contact') is-invalid @enderror" required
                placeholder="Name, phone, email, etc."></textarea>
            @error('referral_contact')
                <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label class="form-label label-required">Reason for Referral / Case Summary</label>
            <textarea name="case_summary" class="form-control" required></textarea>
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
