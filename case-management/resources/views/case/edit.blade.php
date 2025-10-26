<!-- filepath: d:\source\SFFC\case-management\resources\views\cases\edit.blade.php -->
@extends('layouts.app')

@section('header')
    Edit Case
@endsection

@section('content')
    <a href="{{ route('casenote.index', ['case_id' => $case->id]) }}" class="btn btn-sm btn-secondary mb-3">Case
        Notes</a>

    <form class="row g-3 align-items-center" action="{{ route('case.update', $case->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $case->id }}">
        <div class="col-auto">
            <label for="case_identifier">Case Identifier:</label>
            <input id="case_identifier" type="text" name="case_identifier"
                class="border-0 bg-transparent font-extrabold @error('case_identifier') is-invalid @enderror"
                value="{{ old('case_identifier', $case->case_identifier) }}" readonly>
        </div>
        <div class="row g-3">
            <div class="col-auto">
                <label for="status" class="form-label label-required">Case Status</label>
                <select id="case_status_id" name="case_status_id"
                    class="form-select-sm @error('case_status_id') is-invalid @enderror" required>
                    @foreach ($statuses as $status)
                        <option value="{{ $status->id }}"
                            {{ old('case_status_id', $case->case_status_id) == $status->id ? 'selected' : '' }}>
                            {{ $status->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <label class="form-label label-required">Case Open Date</label>
                <input id="start_date" type="date" name="start_date"
                    class="form-control-sm @error('start_date') is-invalid @enderror"
                    value="{{ old('start_date', $case->start_date) }}" required>
                @error('start_date')
                    <span class="invalid-feedback d-block">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-auto">
                <label class="form-label">Case Close Date</label>
                <input type="date" name="end_date" class="form-control-sm @error('end_date') is-invalid @enderror"
                    value="{{ old('end_date', $case->end_date) }}">
                @error('end_date')
                    <span class="invalid-feedback d-block">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row g-3">
            <label for="case_description" class="form-label label-required">Case Description</label>
            <textarea name="case_description" class="form-control-sm" placeholder="Case Description" required>{{ old('case_description', $case->case_description) }}</textarea>
        </div>

        {{-- <x-choices-select id="assigned_staff_id" name="assigned_staff_id" label="Case Manager" url="/peopleSearch"
            labelKey="last_name" :selected="old('assigned_staff_id')" 
            :options="$case->assignedStaff" 
            :selected="$case->$case->assignedStaff->id->toArray()" 
            /> --}}

        {{-- <x-choices-select id="host_family_id" name="host_family_id" label="Host Family" url="/familySearch"
            labelKey="family_name" :selected="old('host_family_id')" />

        <x-choices-select id="client_id" name="client_id" label="Client Family" url="/familySearch"
            labelKey="family_name" :selected="old('client_id')" /> --}}

        <div class="row g-3 align-items-center">
            <div class="col-6">
                <input type="hidden" name="assigned_staff_id" value="">
                <label class="form-label">Case Manager</label>
                <select class="form-select person-select" name="assigned_staff_id">
                    @if ($case->assignedStaff)
                        <option value="{{ $case->assignedStaff->id }}" selected>
                            {{ $case->assignedStaff->last_name . ', ' . $case->assignedStaff->first_name }}
                        </option>
                    @endif
                </select>
            </div>
        </div>
        <div class="col-6">
            <input type="hidden" name="client_family_id" value="">
            <label class="form-label">Client Family</label>
            <select class="family-select form-select" name="client_family_id">
                @if ($case->clientFamily)
                    <option value="{{ $case->clientFamily->id }}" selected>
                        {{ $case->clientFamily->family_name }}
                    </option>
                @endif
            </select>
        </div>
        <div class="col-6">
            <input type="hidden" name="host_family_id" value="">
            <label class="form-label">Host Family</label>
            <select class="family-select form-select" name="host_family_id">
                @if ($case->hostFamily)
                    <option value="{{ $case->hostFamily->id }}" selected>
                        {{ $case->hostFamily->family_name }}
                    </option>
                @endif
            </select>
        </div>

        <div class="row g-3">
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mt-3">Save</button>
                <a href="{{ route('case.index') }}" class="btn btn-secondary mt-3">Cancel</a>
            </div>
        </div>

    </form>
@endsection
