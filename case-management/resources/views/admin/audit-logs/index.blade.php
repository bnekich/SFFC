@extends('layouts.app')

@section('content')
    <div class="table-responsive">
        <table class="table table=light table-striped table-bordered" style="width: 100%">
            <caption class="caption-top">List of Audit Logs</caption>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Action</th>
                    <th>Model Type</th>
                    <th>Model ID</th>
                    <th>Details</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($auditLogs as $auditLog)
                    <tr class="table-light">
                        <td>{{ $auditLog->id }}</td>
                        <td>{{ $auditLog->user_id }}</td>
                        <td>{{ $auditLog->action }}</td>
                        <td>{{ $auditLog->model_type }}</td>
                        <td>{{ $auditLog->model_id }}</td>
                        <td>{{ $auditLog->details }}</td>
                        <td>{{ $auditLog->created_at }}</td>
                        <td>
                            <a href="{{ route('audit-logs.show', $auditLog->id) }}" class="btn btn-info">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $auditLogs->links('') }}
    </div>
@endsection
