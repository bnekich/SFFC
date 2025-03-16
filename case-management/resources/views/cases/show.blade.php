<@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Case Details</h1>
        <p><strong>Case Identifier:</strong> {{ $case->case_identifier }}</p>
        <p><strong>Case Description:</strong> {{ $case->case_description }}</p>
        <!-- Add other fields as needed -->
        <a href="{{ route('cases.index') }}" class="btn btn-secondary">Back to Cases</a>
    </div>
@endsection
