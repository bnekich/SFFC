@extends('layouts.app')
@section('content')
    <div class="container">
    @section('header')
        <h3>Case Detail</h3>
    @endsection

    <p><strong>Case Identifier:</strong> {{ $case->case_identifier }}</p>
    <p><strong>Case Description:</strong> {{ $case->case_description ?? 'N/A' }}</p>
    <p><strong>Client Family:</strong> {{ optional($case->clientFamily)->family_name ?? 'N/A' }}</p>
    <p><strong>Host Family:</strong> {{ optional($case->hostFamily)->family_name ?? 'N/A' }}</p>
    <p><strong>Case Manager:</strong>
        @if ($case->assignedStaff)
            {{ $case->assignedStaff->first_name }} {{ $case->assignedStaff->last_name }}
        @else
            N/A
        @endif
    </p>
    <p><strong>Case Status:</strong>
        {{ $case->status ?? 'N/A' }}
    </p>
    <p><strong>Case Start Date:</strong>
        {{ $case->start_date ? \Carbon\Carbon::parse($case->start_date)->isoFormat('LL') : 'N/A' }}
    </p>
    <p><strong>Case End Date:</strong>
        {{ $case->end_date ? \Carbon\Carbon::parse($case->end_date)->isoFormat('LL') : 'N/A' }}
    </p>
    <p><strong>Created By (ID):</strong> {{ $case->created_by ?? 'N/A' }}</p>
    <a href="{{ route('case.index') }}" class="btn btn-secondary">Back to Cases</a>
</div>
@endsection
