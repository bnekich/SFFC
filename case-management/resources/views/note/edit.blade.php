@extends('layouts.app')

@section('title')
    - Edit Note
@endsection

@section('content')
@section('header')
    Edit Note
@endsection
<form class="space-y-6" action="{{ route('note.update', $note) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="title" class="sffc-label">Note Title<span class=" text-red-500">*</span></label>
    <input id="title" type="text" name="title" placeholder="Note Title"
        class="sffc-text-input @error('title') border-red-500 @enderror" value="{{ old('title', $note->title) }}"
        required>
    @error('title')
        <span class="sffc-text-input-error">{{ $message }}</span>
    @enderror

    <label for="note" class="sffc-label">Note Content<span class=" text-red-500">*</span></label>
    <textarea id="note" name="note" class="sffc-text-input" required>{{ old('note', $note->note) }}</textarea>
    @error('note')
        <span class="sffc-text-input-error">{{ $message }}</span>
    @enderror

    <label for="comments" class="sffc-label">Comments</label>
    <textarea id="comments" name="comments" class="sffc-text-input">{{ old('comments', $note->comments) }}</textarea>
    @error('comments')
        <span class="sffc-text-input-error">{{ $message }}</span>
    @enderror

    <label for="note_privacy_id" class="sffc-label">Privacy Level</label>
    <select id="note_privacy_id" name="note_privacy_id"
        class="sffc-text-input @error('note_privacy_id') border-red-500 @enderror">
        <option value=""> (Select)</option>
        @foreach ($notePrivacies as $notePrivacy)
            <option value="{{ $notePrivacy->id }}"
                {{ old('note_privacy_id', $note->note_privacy_id) == $notePrivacy->id ? 'selected' : '' }}>
                {{ $notePrivacy->name }}</option>
        @endforeach
        </option>
    </select>
    @error('note_privacy_id')
        <span class="sffc-text-input-error">{{ $message }}</span>
    @enderror

    <label for="note_status_id" class="sffc-label">Note Status</label>
    <select id="note_status_id" name="note_status_id"
        class="sffc-text-input @error('note_status_id') border-red-500 @enderror">
        <option value=""> (Select)</option>
        <!-- Placeholder: Replace with NoteStatus model options -->
        <option value="1" {{ old('note_status_id', $note->note_status_id) == 1 ? 'selected' : '' }}>Draft
        </option>
        <option value="2" {{ old('note_status_id', $note->note_status_id) == 2 ? 'selected' : '' }}>
            Pending</option>
        <option value="3" {{ old('note_status_id', $note->note_status_id) == 3 ? 'selected' : '' }}>
            Approved</option>
    </select>
    @error('note_status_id')
        <span class="sffc-text-input-error">{{ $message }}</span>
    @enderror
    <input id="approved" type="checkbox" name="approved" value="1" class="sffc-checkbox"
        {{ old('approved', $note->approved) ? 'checked' : '' }}>
    <label for="approved" class="sffc-label">Approved</label>
    @error('approved')
        <span class="sffc-text-input-error">{{ $message }}</span>
    @enderror

    <x-choices-select id="tags" name="tags[]" label="Tags" url="/tagSearch" multiple="true"
        placeholder="Search for Tags..." labelKey="name" :options="$note->tags" :selected="$note->tags->pluck('id')->toArray()" />

    <x-choices-select id="cases" name="cases[]" label="Attach to Cases" url="/api/noteables/" multiple="true"
        placeholder="Search for Cases..." labelKey="case_identifier" noteType="cases" />

    <x-choices-select id="volunteers" name="volunteers[]" label="Attach to Volunteers" url="/api/noteables/"
        multiple="true" placeholder="Search for Volunteers..." noteType="volunteers" :options="$volunteers" :selected="$volunteerIds"
        labelKey="name" />

    <button type="submit" class="sffc-btn-primary mt-3">Save</button>
    <a href="{{ route('note.show', $note) }}" class="sffc-btn-cancel mt-3">Cancel</a>
</form>
@endsection
