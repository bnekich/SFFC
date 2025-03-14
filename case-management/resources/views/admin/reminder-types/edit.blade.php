@extends('layouts.app')

@section('title', 'Edit Reminder Type')

@section('content')
    <h1>Edit Reminder Type</h1>
    <form action="{{ route('reminder-types.update', $reminderType) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ old('name', $reminderType->name) }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('reminder-types.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
