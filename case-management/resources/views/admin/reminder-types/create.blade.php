@extends('layouts.app')

@section('title', 'Add Reminder Type')

@section('content')
    <h1>Add Reminder Type</h1>
    <form action="{{ route('reminder-types.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('reminder-types.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
