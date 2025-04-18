<!-- filepath: d:\source\SFFC\case-management\resources\views\cases\edit.blade.php -->
@extends('layouts.app')

@section('title')
    - Case Edit
@endsection

@section('content')
    <div class="container">
        <h3>Edit Case</h3>
        <a href="{{ route('casenote.index', ['case_id' => $case->id]) }}" class="btn btn-sm btn-secondary mb-3">Case
            Notes</a>

        <form action="{{ route('case.update', $case->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="case_identifier" class="form-label">Case Identifier</label>
                <input type="text" name="case_identifier" class="form-control" value="{{ $case->case_identifier }}"
                    aria-describedby="caseIdentifier" readonly>
                <div id="caseIdentifier" class="form-text">Case Identifier is a unique value assigned by the initiating
                    person and cannot be changed.</div>
            </div>
            <div class="mb-3">
                <label for="case_description" class="form-label">Case Description</label>
                <textarea name="case_description" class="form-control">{{ $case->case_description }}</textarea>
            </div>


            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
