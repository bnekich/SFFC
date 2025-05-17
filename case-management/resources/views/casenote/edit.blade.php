@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Edit Case Note for Case #{{ $casenote->id }}</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('casenote.update', $casenote) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="case_id" value="{{ $casenote->case->id }}">
                            . <div class="mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control @error('subject') is-invalid @enderror"
                                    id="subject" name="subject" value="{{ old('subject', $casenote->subject) }}">
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="note" class="form-label">Note</label>
                                <textarea class="form-control @error('note') is-invalid @enderror" id="note" name="note" rows="5">{{ old('note', $casenote->note) }}</textarea>
                                @error('note')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="privacy_level" class="form-label">Privacy Level</label>
                                <select class="form-control @error('privacy_level') is-invalid @enderror" id="privacy_level"
                                    name="privacy_level">
                                    <option value="public"
                                        {{ old('privacy_level', $casenote->privacy_level) == 'public' ? 'selected' : '' }}>
                                        Public</option>
                                    <option value="private"
                                        {{ old('privacy_level', $casenote->privacy_level) == 'private' ? 'selected' : '' }}>
                                        Private</option>
                                    <option value="restricted"
                                        {{ old('privacy_level', $casenote->privacy_level) == 'restricted' ? 'selected' : '' }}>
                                        Restricted</option>
                                </select>
                                @error('privacy_level')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control @error('status') is-invalid @enderror" id="status"
                                    name="status">
                                    <option value="open"
                                        {{ old('status', $casenote->status) == 'open' ? 'selected' : '' }}>Open</option>
                                    <option value="closed"
                                        {{ old('status', $casenote->status) == 'closed' ? 'selected' : '' }}>Closed
                                    </option>
                                    <option value="pending"
                                        {{ old('status', $casenote->status) == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tags" class="form-label">Tags</label>
                                <select class="form-control @error('tags') is-invalid @enderror" id="tags"
                                    name="tags[]" multiple>
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}"
                                            {{ in_array($tag->id, old('tags', $casenote->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
                                            {{ $tag->name }}</option>
                                    @endforeach
                                </select>
                                @error('tags')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="is_approved" class="form-label">Approved</label>
                                <input type="hidden" name="is_approved" value="0" />
                                <input type="checkbox" id="is_approved" name="is_approved" value="1"
                                    {{ old('is_approved', $casenote->is_approved) ? 'checked' : '' }}>
                                @error('is_approved')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('casenote.index', ['case_id' => $casenote->case->id]) }}"
                                class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
