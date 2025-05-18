@extends('layouts.app')

@section('title')
    - Add Case
@endsection

@section('content')
    <div class="container">
    @section('header')
        <div class="row g3">
            <h3>Add Case</h3>
        </div>
    @endsection
    <form class="row g-3 align-items-center" action="{{ route('case.store') }}" method="POST">
        @csrf
        <div class="col-auto">
            <label for="case_identifier" class="form-label label-required">Case Identifier</label>
            <input id="case_identifier" type="text" name="case_identifier" placeholder="A Unique Identifier"
                class="form-control-sm @error('case_identifier') is-valid @enderror"
                value="{{ old('case_identifier') }}" required>
            @error('case_identifier')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-auto">
            <label for="status" class="form-label label-required">Case Status</label>
            <select id="status" name="status" class="form-select-sm @error('status') is-invalid @enderror" required>
                <option value=""> (Select)</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status->value }}" {{ old('status') == $status->value ? 'selected' : '' }}>
                        {{ $status->label() }}
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
        <div class="col-2">
            <label for="assigned_staff_id" class="form-label">Case Manager</label>
            <select id="assigned_staff_id" class="form-select person-select" name="assigned_staff_id">
                <option value=""></option>
            </select>
        </div>
        <div class="col-2">
            <label for="client_id" class="form-label">Client Family</label>
            <select id="client_family_id" class="family-select form-select" name="client_family_id">
                <option value=""></option>
            </select>
        </div>
        <div class="col-2">
            <label for="host_family_id" class="form-label">Host Family</label>
            <select id="host_family_id" class="family-select form-select" name="host_family_id">
                <option value=""></option>
            </select>
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
