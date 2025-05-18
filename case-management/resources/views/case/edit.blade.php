<!-- filepath: d:\source\SFFC\case-management\resources\views\cases\edit.blade.php -->
@extends('layouts.app')

@section('header')
    <div class="row g-3">
        <h3>Edit Case</h3>
    </div>
@endsection

@section('content')
    <div class="container">
        <a href="{{ route('casenote.index', ['case_id' => $case->id]) }}" class="btn btn-sm btn-secondary mb-3">Case
            Notes</a>

        <form class="row g-3 align-items-center" action="{{ route('case.update', $case->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="col-auto">
                <input type="text" name="case_identifier"
                    class="form-control-sm @error('case_identifier') is-valid @enderror"
                    value="{{ old('case_identifier', $case->case_identifier) }}" readonly>
            </div>
            <div class="col-auto">
                <label class="form-label">Case Status</label>
                <select name="status" class="form-select-sm @error('status') is-invalid @enderror">
                    <option value=""> (Select)</option>
                    @foreach ($statuses as $status)
                        <option value="{{ $status->value }}"
                            {{ old('status', $case->status) == $status->value ? 'selected' : '' }}>
                            {{ $status->label() }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <label class="form-label">Case Open Date</label>
                <input type="date" name="start_date" class="form-control-sm @error('start_date') is-invalid @enderror"
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
            <div class="row g-3">
                <textarea name="case_description" class="form-control-sm" placeholder="Case Description">{{ old('case_description', $case->case_description) }}</textarea>
            </div>
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
    </div>
@endsection
