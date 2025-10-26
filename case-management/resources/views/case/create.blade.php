@extends('layouts.app')

@section('title')
    - Add Case
@endsection

@section('content')
    <div class="container">
    @section('header')
        Add Case
    @endsection
    <form class="row g-3 align-items-center" action="{{ route('case.store') }}" method="POST">
        @csrf
        <div class="col-auto">
            <label for="case_identifier" class="form-label label-required">Case Identifier</label>
            <input id="case_identifier" type="text" name="case_identifier" placeholder="A Unique Identifier"
                class="form-control-sm @error('case_identifier') is-invalid @enderror"
                value="{{ old('case_identifier') }}" required>
            @error('case_identifier')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-auto">
            <label for="case_status_id" class="form-label label-required">Case Status</label>
            <select id="case_status_id" name="case_status_id"
                class="form-select-sm @error('case_status_id') is-invalid @enderror" required>
                <option value=""> (Select)</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status->id }}" {{ old('status') == $status->id ? 'selected' : '' }}>
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-auto">
            <label for="start_date" class="form-label label-required">Case Open Date</label>
            <input id="start_date" type="date" name="start_date"
                class="form-control-sm @error('start_date') is-invalid @enderror"
                value="{{ old('start_date', \Carbon\Carbon::now()->format('Y-m-d')) }}" required>
            @error('start_date')
                <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="case_description" class="form-label label-required">Case Description</label>
            <textarea id="case_description" name="case_description" class="form-control" required>{{ old('case_description') }}</textarea>
        </div>
        <x-choices-select id="assigned_staff_id" name="assigned_staff_id" label="Case Manager" url="/peopleSearch"
            labelKey="last_name" :selected="old('assigned_staff_id')" />

        <x-choices-select id="host_family_id" name="host_family_id" label="Host Family" url="/familySearch"
            labelKey="family_name" :selected="old('host_family_id')" />

        <x-choices-select id="client_id" name="client_id" label="Client Family" url="/familySearch"
            labelKey="family_name" :selected="old('client_id')" />

        <div class="row g-3">
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mt-3">Save</button>
                <a href="{{ route('case.index') }}" class="btn btn-secondary mt-3">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
