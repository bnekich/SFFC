@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Audit Log Details</h1>
        <p><strong>Action:</strong> {{ $auditLog->action }}</p>
        <p><strong>Model Type:</strong> {{ $auditLog->model_type }}</p>
        <p><strong>Model ID:</strong> {{ $auditLog->model_id }}</p>
        <p><strong>Details:</strong> {{ $auditLog->details }}</p>
        <a href="{{ route('audit-logs.index') }}" class="btn btn-secondary">Back to Audit Logs</a>
    </div>
@endsection
