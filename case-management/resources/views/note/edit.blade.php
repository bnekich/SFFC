@extends('layouts.app')

@section('title')
    - Edit Note
@endsection

@section('content')
    <div class="container">
    @section('header')
        Edit Note
    @endsection
    <form class="row g-3 align-items-center" action="{{ route('note.update', $note) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="col-12">
            <label for="title" class="form-label label-required">Note Title</label>
            <input id="title" type="text" name="title" placeholder="Note Title"
                class="form-control-sm @error('title') is-invalid @enderror" value="{{ old('title', $note->title) }}"
                required>
            @error('title')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-12">
            <label for="note" class="form-label label-required">Note Content</label>
            <textarea id="note" name="note" class="form-control" required>{{ old('note', $note->note) }}</textarea>
            @error('note')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-12">
            <label for="comments" class="form-label">Comments</label>
            <textarea id="comments" name="comments" class="form-control">{{ old('comments', $note->comments) }}</textarea>
            @error('comments')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-12">
            <label for="note_privacy_id" class="form-label">Privacy Level</label>
            <select id="note_privacy_id" name="note_privacy_id"
                class="form-select-sm @error('note_privacy_id') is-invalid @enderror">
                <option value=""> (Select)</option>
                @foreach ($notePrivacies as $notePrivacy)
                    <option value="{{ $notePrivacy->id }}"
                        {{ old('note_privacy_id') == $notePrivacy->id ? 'selected' : '' }}>
                        {{ $notePrivacy->name }}</option>
                @endforeach
                </option>
            </select>
            @error('note_privacy_id')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-12">
            <label for="note_status_id" class="form-label">Note Status</label>
            <select id="note_status_id" name="note_status_id"
                class="form-select-sm @error('note_status_id') is-invalid @enderror">
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
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-12">
            <div class="form-check">
                <input id="approved" type="checkbox" name="approved" value="1" class="form-check-input"
                    {{ old('approved', $note->approved) ? 'checked' : '' }}>
                <label for="approved" class="form-check-label">Approved</label>
                @error('approved')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <x-choices-select id="cases" name="cases[]" label="Attach to Cases" url="/api/noteables/"
                multiple="true" placeholder="Search for Cases..." labelKey="case_identifier" noteType="cases" />

        </div>
        <div class="col-12">
            <x-choices-select id="volunteers" name="volunteers[]" label="Attach to Volunteers" url="/api/noteables/"
                multiple="true" placeholder="Search for Volunteers..." noteType="volunteers" />
            <div class="row g-3">
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mt-3">Save</button>
                    <a href="{{ route('note.show', $note) }}" class="btn btn-secondary mt-3">Cancel</a>
                </div>
            </div>
    </form>
</div>
@endsection
