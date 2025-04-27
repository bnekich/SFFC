@extends('layouts.app')

@section('header')
    <div class="row g3">
        <h3>Create New Case</h3>
    </div>
@endsection

@section('content')
    <div class="container">
        <form class="row g-3 align-items-center" action="{{ route('case.store') }}" method="POST">
            @csrf
            <div class="col-auto">
                <input type="text" name="case_identifier" placeholder="Case Identifier"
                    class="form-control-sm @error('case_identifier') is-valid @enderror" value="{{ old('case_identifier') }}"
                    required>
                @error('case_identifier')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-auto">
                <label class="form-label">Case Status</label>
                <select name="status" class="form-select-sm @error('status') is-invalid @enderror">
                    <option value=""> (Select)</option>
                    @foreach ($statuses as $status)
                        <option value="{{ $status->value }}" {{ old('status') == $status->value ? 'selected' : '' }}>
                            {{ $status->label() }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <label class="form-label">Case Open Date</label>
                <input type="date" name="start_date" class="form-control-sm @error('start_date') is-invalid @enderror"
                    value="{{ old('start_date', \Carbon\Carbon::now()->format('Y-m-d')) }}" required>
                @error('start_date')
                    <span class="invalid-feedback d-block">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-auto">
                <label class="form-label">Case Close Date</label>
                <input type="date" name="end_date" class="form-control-sm @error('end_date') is-invalid @enderror"
                    value="{{ old('end_date', \Carbon\Carbon::now()->format('Y-m-d')) }}">
                @error('end_date')
                    <span class="invalid-feedback d-block">{{ $message }}</span>
                @enderror
            </div>
            <div class="row g-3">
                <textarea name="case_description" class="form-control-sm" placeholder="Case Description">{{ old('case_description') }}</textarea>
            </div>
            <div class="row g-3 align-items-center">
                <div class="col-6">
                    <label class="form-label">Case Manager</label>
                    <select class="form-select person-select" name="person_id"></select>
                </div>
            </div>
            <div class="col-6">
                <label class="form-label">Client Family</label>
                <select class="family-select form-select" name="client_family_id"></select>
            </div>
            <div class="col-6">
                <label class="form-label">Host Family</label>
                <select class="family-select form-select" name="host_family_id"></select>
            </div>

            <div class="row g-3">
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mt-3">Create</button>
                    <a href="{{ route('case.index') }}" class="btn btn-secondary mt-3">Cancel</a>
                </div>
            </div>
        </form>
    </div>
@endsection
