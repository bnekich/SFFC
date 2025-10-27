@extends('layouts.app')

@section('title')
    - Add Note
@endsection

@section('content')
@section('header')
    @if ($preselectedVolunteer->count() > 0)
        Add Note to Volunteer ( {{ $preselectedVolunteer[0]['full_name'] }} )
    @elseif ($preselectedCase->count() > 0)
        Add Note to Case ( {{ $preselectedCase[0]['case_identifier'] }} )
    @else
        Add Note
    @endif
@endsection
<form class="space-y-6" action="{{ route('note.store') }}" method="POST">
    @csrf
    <label for="title" class="sffc-label">Note Title<span class=" text-red-500">*</span></label>
    <input id="title" type="text" name="title" placeholder="Note Title"
        class="sffc-text-input @error('title') border-red-500 @enderror" value="{{ old('title') }}" required>
    @error('title')
        <span class="sffc-text-input-error">{{ $message }}</span>
    @enderror
    <label for="note" class="sffc-label">Note Content<span class=" text-red-500">*</span></label>
    <textarea id="note" name="note" class="sffc-text-input" required>{{ old('note') }}</textarea>
    @error('note')
        <span class="sffc-text-input-error">{{ $message }}</span>
    @enderror
    <label for="comments" class="sffc-label">Comments</label>
    <textarea id="comments" name="comments" class="sffc-text-input">{{ old('comments') }}</textarea>
    @error('comments')
        <span class="sffc-text-input-error">{{ $message }}</span>
    @enderror
    <x-choices-select id="tags" name="tags[]" label="Tags" url="/tagSearch" multiple="true"
        placeholder="Search for Tags..." labelKey="name" />

    <label for="note_privacy_id" class="sffc-label">Privacy Level</label>
    <select id="note_privacy_id" name="note_privacy_id"
        class="sffc-text-input @error('note_privacy_id') border-red-500 @enderror">
        <option value=""> (Select)</option>
        @foreach ($notePrivacies as $notePrivacy)
            <option value="{{ $notePrivacy->id }}" {{ old('note_privacy_id') == $notePrivacy->id ? 'selected' : '' }}>
                {{ $notePrivacy->name }}</option>
        @endforeach
    </select>
    @error('note_privacy_id')
        <span class="sffc-text-input-error">{{ $message }}</span>
    @enderror
    <label for="note_status_id" class="sffc-label">Note Status</label>
    <select id="note_status_id" name="note_status_id"
        class="sffc-text-input @error('note_status_id') border-red-500 @enderror">
        <option value=""> (Select)</option>
        @foreach ($noteStatuses as $status)
            <option value="{{ $status->id }}" {{ old('note_status_id') == $status->id ? 'selected' : '' }}>
                {{ $status->name }}</option>
        @endforeach
    </select>
    @error('note_status_id')
        <span class="sffc-text-input-error">{{ $message }}</span>
    @enderror
    <input id="approved" type="checkbox" name="approved" value="1"
        class="sffc-checkbox @error('approved') border-text-red @enderror" {{ old('approved') ? 'checked' : '' }}>
    <label for="approved" class="form-check-label">Approved</label>
    @error('approved')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
    @if ($preselectedCase->count() > 0)
        <x-choices-select id="cases" name="cases[]" label="Attach to Cases" url="/api/noteables" multiple="true"
            placeholder="Search for Cases..." labelKey="case_identifier" noteType="cases" :options="$preselectedCase"
            :selected="$preselectedCaseIds" />
    @else
        <x-choices-select id="cases" name="cases[]" label="Attach to Cases" url="/api/noteables" multiple="true"
            placeholder="Search for Cases..." labelKey="case_identifier" noteType="cases" />
    @endif

    @if ($preselectedVolunteer->count() > 0)
        <x-choices-select id="volunteers" name="volunteers[]" label="Attach to Volunteers" url="/api/noteables"
            multiple="true" placeholder="Search for Volunteers..." noteType="volunteers" :options="$preselectedVolunteer"
            :selected="$preselectedVolunteerIds" labelKey="full_name" />
    @else
        <x-choices-select id="volunteers" name="volunteers[]" label="Attach to Volunteers" url="/api/noteables"
            multiple="true" placeholder="Search for Volunteers..." noteType="volunteers" />
    @endif
    <div class="col-auto">
        <button type="submit" class="sffc-btn-primary mt-3">Save</button>
        <a href="{{ route('note.index') }}" class="sffc-btn-cancel mt-3">Cancel</a>
    </div>
</form>
@endsection
