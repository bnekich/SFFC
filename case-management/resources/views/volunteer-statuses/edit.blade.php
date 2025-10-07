@extends('layouts.app')

@section('title')
    - Edit Volunteer Status
@endsection

@section('content')
    <div class="container">
    @section('header')
        <h3>Edit Status - {{ $volunteerStatus->name }}</h3>
    @endsection
    <form class="row g-3 align-items-center" action="{{ route('volunteer-statuses.update', $volunteerStatus) }}"
        method="POST">
        @csrf
        @method('PUT')
        <div class="col-auto">
            <label for="name" class="form-label label-required">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ old('name', $volunteerStatus->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="row g-3">
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('volunteer-statuses.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
