@extends('layouts.app')
@section('header')
    Add Family
@endsection

@section('content')
    <div class="container mt-4">
        <form class="row g-3 align-items-center" action="{{ route('family.store') }}" method="POST">
            @csrf
            <div class="col-auto">
                <label class="form-label label-required">Family Name</label>
                <input type="text" id="family_name" name="family_name" placeholder="Family Name"
                    class="form-control-sm @error('family_name') is-invalid @enderror" value="{{ old('family_name') }}"
                    required>
                @error('family_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <x-address-form :address="$address" :states="$states" />
            <div class="row g-3 align-items-center">
                <div class="col-6">
                    <label class="form-label">Associated People</label>
                    <select class="form-select person-select" name="person_ids[]" multiple></select>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Create Family</button>
                    <a href="{{ route('family.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>

        </form>
    @endsection
