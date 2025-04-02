@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create New Case</h1>
        <form action="{{ route('case.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="case_identifier">Case Identifier</label>
                <input type="text" name="case_identifier" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="case_description">Case Description</label>
                <textarea name="case_description" class="form-control"></textarea>
            </div>
            <!-- Add other fields as needed -->
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
