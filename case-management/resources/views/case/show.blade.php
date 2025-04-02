<@extends('layouts.app') @section('title') - Case Detail @endsection @section('content') <div class="container">
    <h3>Case Detail</h3>
    <p><strong>Case Identifier:</strong> {{ $case->case_identifier }}</p>
    <p><strong>Case Description:</strong> {{ $case->case_description }}</p>
    <?php
    // TODO Finish this view
    ?>
    <a href="{{ route('case.index') }}" class="btn btn-secondary">Back to Cases</a>
    </div>
@endsection
