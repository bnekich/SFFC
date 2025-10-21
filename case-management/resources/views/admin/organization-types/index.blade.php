@extends('layouts.app')

@section('title')
    - Organization Types
@endsection

@section('content')
@section('header')
    Organization Types
@endsection
<div class="row mb-3">
    <x-search route="organization-types.index" placeholder="Name" />
    <div class="col-auto align-items-end d-flex justify-content-end">
        @can('type-create')
            <a href="{{ route('organization-types.create') }}" class="btn btn-sm btn-primary">Add New Type</a>
        @endcan
    </div>
</div>
<table class="table table-striped">
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
                        <a href="{{ route('organization-types.edit', $type) }}" class="btn btn-sm btn-warning">Edit</a>
                        <x-delete-confirmation :route="route('organization-types.destroy', $type)" :item-id="$type->id"
                            message="Are you sure you want to delete this organization type?" />
                    </td>
                @endcanany
            </tr>
        @empty
            <tr>
                <td colspan="2">No organization types found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
