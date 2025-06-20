<!-- resources/views/admin/organization-types/edit.blade.php -->
@extends('layouts.app')

@section('title')
    - Edit Organization Type
@endsection

@section('content')
    <div class="container">
    @section('header')
        <h3>Edit {{ $organizationType->name }}</h3>
    @endsection
    <form class="row g-3 align-items-center" action="{{ route('organization-types.update', $organizationType) }}"
        method="POST">
        <form action="{{ route('organization-types.update', $organizationType) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="col-auto">
                <label for="name" class="form-label label-required">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                    name="name" value="{{ old('name', $organizationType->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="row g-3">
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('organization-types.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </form>
</div>
@endsection
