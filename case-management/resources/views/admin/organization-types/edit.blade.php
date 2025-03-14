<!-- resources/views/admin/organization-types/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Edit Organization Type')

@section('content')
    <h1>Edit Organization Type</h1>
    <form action="{{ route('organization-types.update', $organizationType) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ old('name', $organizationType->name) }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('organization-types.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
