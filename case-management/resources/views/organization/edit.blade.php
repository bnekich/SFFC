@extends('layouts.app')

@section('title', 'Edit Organization')

@section('content')
    <h1>Edit Organization: {{ $organization->name }}</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('organization.update', $organization) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Name Field -->
        <div class="form-group">
            <label for="name">Organization Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $organization->name) }}" required>
            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- Persons Multi-Select -->
        <div class="form-group">
            <label for="person_ids">Associated Persons (hold Ctrl/Cmd to select multiple)</label>
            <select name="person_ids[]" id="person_ids" multiple
                class="form-control @error('person_ids') is-invalid @enderror">
                @foreach ($persons as $person)
                    <option value="{{ $person->id }}" {{ in_array($person->id, $selectedPersons) ? 'selected' : '' }}>
                        {{ $person->first_name }} {{ $person->last_name }}
                    </option>
                @endforeach
            </select>
            @error('person_ids')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update Organization</button>
        <a href="{{ route('organization.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
