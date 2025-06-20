@extends('layouts.app')

@section('title', 'Reminder Types')

@section('content')
@section('header')
    <h3>Reminder Types</h3>
@endsection
@can('types-create')
    <a href="{{ route('reminder-types.create') }}" class="btn btn-primary mb-3">Add New Type</a>
@endcan
<a href="{{ route('reminder-types.create') }}" class="btn btn-primary mb-3">Add New Type</a>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Name</th>
            @canany(['types-create', 'types-edit', 'types-delete'])
                <th>Actions</th>
            @endcanany
        </tr>
    </thead>
    <tbody>
        @forelse($types as $type)
            <tr>
                <td>{{ $type->name }}</td>
                @canany(['types-create', 'types-edit', 'types-delete'])
                    <td>
                        <a href="{{ route('reminder-types.edit', $type) }}" class="btn btn-sm btn-warning">Edit</a>
                        @can('types-delete')
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
