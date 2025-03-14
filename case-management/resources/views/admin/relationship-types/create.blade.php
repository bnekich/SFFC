@extends('layouts.app')

@section('title', 'Add Relationship Type')

@section('content')
    <h1>Add Relationship Type</h1>
    <form action="{{ route('relationship-types.store') }}" method="POST">
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
        <a href="{{ route('relationship-types.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
