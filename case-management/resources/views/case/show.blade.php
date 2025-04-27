<@extends('layouts.app') @section('title') - Case Detail @endsection @section('content') <div class="container">
    <h3>Case Detail</h3>
    <p><strong>Case Identifier:</strong> {{ $case->case_identifier }}</p>
    <p><strong>Case Description:</strong> {{ $case->case_description }}</p>
    <p><strong>Client Family:</strong> {{ $case->clientFamily->family_name }}</p>
    <p><strong>Host Family:</strong> {{ $case->hostFamily->family_name }}</p>
    <p><strong>Case Manager:</strong> {{ $case->assignedStaff->first_name . ' ' . $case->assignedStaff->last_name }}
    </p>
    <p><strong>Case Status:</strong> {{ $case->status }} </p>
    <p><strong>Case Start Date:</strong> {{ $case->start_date }}</p>
    <p><strong>Case End Date:</strong> {{ $case->end_date }}</p>
    <p><strong>Created By:</strong> {{ $case->created_by }}</p>
    <a href="{{ route('case.index') }}" class="btn btn-secondary">Back to Cases</a>
    </div>
@endsection
