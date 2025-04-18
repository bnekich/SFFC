@extends('layouts.app')

@section('content')
    <div class="container">
    @section('header')
        <div class="row g3">
            <h3>Create New Case</h3>
        </div>
    @endsection
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
            <label for="case_description">Case Description</label>
            <textarea name="case_description" class="form-control"></textarea>
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

        <!-- Add other fields as needed -->
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
