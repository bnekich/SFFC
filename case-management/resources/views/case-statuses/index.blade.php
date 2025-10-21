@extends('layouts.app')

@section('title')
    - Case Statuses
@endsection

@section('content')

@section('header')
    Case Statuses
@endsection
<div class="row mb-3">
    <div class="col-auto align-items-end d-flex justify-content-end">
        <a href="{{ route('case-statuses.create') }}" class="btn btn-primary">Create New Case Status</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($caseStatuses as $caseStatus)
                <tr>
                    <td>{{ $caseStatus->name }}</td>
                    <td>
                        <a href="{{ route('case-statuses.edit', $caseStatus) }}" class="btn btn-warning btn-sm">Edit</a>
                        <x-delete-confirmation :route="route('case-statuses.destroy', $caseStatus)" :item-id="$caseStatus->id"
                            message="Are you sure you want to delete this case status?" />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">No case statuses found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
