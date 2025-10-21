@extends('layouts.app')

@section('title')
    - Volunteer Statuses
@endsection

@section('content')

@section('header')
    Volunteer Statuses
@endsection
<div class="row mb-3">
    <div class="col-auto align-items-end d-flex justify-content-end">
        <a href="{{ route('volunteer-statuses.create') }}" class="btn btn-primary">Create New Volunteer Status</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($statuses as $status)
                <tr>
                    <td>{{ $status->name }}</td>
                    <td>
                        <a href="{{ route('volunteer-statuses.edit', $status) }}" class="btn btn-warning btn-sm">Edit</a>
                        <x-delete-confirmation :route="route('volunteer-statuses.destroy', $status)" :item-id="$status->id"
                            message="Are you sure you want to delete this status?" />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">No statuses found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
