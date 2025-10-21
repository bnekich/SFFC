@extends('layouts.app')

@section('title', 'Reminder Types')

@section('content')
@section('header')
    Reminder Types
@endsection
@can('type-create')
    <a href="{{ route('reminder-types.create') }}" class="btn btn-primary mb-3">Add New Type</a>
@endcan
<a href="{{ route('reminder-types.create') }}" class="btn btn-primary mb-3">Add New Type</a>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Name</th>
            @canany(['type-create', 'type-edit', 'type-delete'])
                <th>Actions</th>
            @endcanany
        </tr>
    </thead>
    <tbody>
        @forelse($types as $type)
            <tr>
                <td>{{ $type->name }}</td>
                @canany(['type-create', 'type-edit', 'type-delete'])
                    <td>
                        <a href="{{ route('reminder-types.edit', $type) }}" class="btn btn-sm btn-warning">Edit</a>
                        @can('type-delete')
                            <x-delete-confirmation :route="route('reminder-types.destroy', $type)" :item-id="$type->id"
                                message="Are you sure you want to delete this reminder type?" />
                        @endcan
                    </td>
                @endcanany
            </tr>
        @empty
            <tr>
                <td colspan="3">No reminder types found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
