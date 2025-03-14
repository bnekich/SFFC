<!-- filepath: d:\source\SFFC\case-management\resources\views\cases\edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Case</h1>
        <form action="{{ route('cases.update', $case->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="case_identifier">Case Identifier</label>
                <input type="text" name="case_identifier" class="form-control" value="{{ $case->case_identifier }}" required>
            </div>
            <div class="form-group">
                <label for="case_description">Case Description</label>
                <textarea name="case_description" class="form-control">{{ $case->case_description }}</textarea>
            </div>
            <!-- Add other fields as needed -->
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
