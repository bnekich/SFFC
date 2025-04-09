@extends('layouts.app')

@section('title', 'Create Organization')

@section('content')
    <h1>Create New Organization</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('organization.store') }}" method="POST">
        @csrf

        <!-- Name Field -->
        <div class="form-group">
            <label for="name">Organization Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}" required>
            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <x-address-form :address="$address" :states="$states" />

        <!-- Persons Multi-Select -->
        <div class="form-group">
            <label for="person_ids">Associated Persons (hold Ctrl/Cmd to select multiple)</label>
            <select name="person_ids[]" id="person_ids" multiple
                class="form-control @error('person_ids') is-invalid @enderror">
                @foreach ($persons as $person)
                    <option value="{{ $person->id }}">{{ $person->first_name }} {{ $person->last_name }}</option>
                @endforeach
            </select>
            @error('person_ids')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Create Organization</button>
        <a href="{{ route('organization.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
