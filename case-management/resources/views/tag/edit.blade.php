@extends('layouts.app')

@section('title')
    - Edit Tag
@endsection

@section('header')
    Edit {{ $tag->name }}
@endsection

@section('content')
    <form class="space-y-6" method="POST" action="{{ route('tag.update', $tag->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="sffc-form-label mb-2">Tag Name<span class=" text-red-500">*</span></label>
            <input type="text" class="sffc-text-input @error('name') border-red-500 @enderror" id="name" name="name"
                value="{{ old('name', $tag->name) }}" placeholder="A Unique Name" required>
            @error('name')
                <div class="sffc-text-input-error">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="sffc-btn-primary">Save</button>
        <a href="{{ route('tag.index') }}" class="sffc-btn-cancel">Cancel</a>
    </form>
@endsection
