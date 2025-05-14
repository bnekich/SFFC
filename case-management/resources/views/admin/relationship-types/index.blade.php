@extends('layouts.app')

@section('title', 'Relationship Types')

@section('content')
@section('header')
    <h3>Relationship Types</h3>
@endsection
@can('types-create')
    <a href="{{ route('relationship-types.create') }}" class="btn btn-primary mb-3">Add New Type</a>
@endcan
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
                        <a href="{{ route('relationship-types.edit', $type) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('relationship-types.destroy', $type) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure you want to delete this type?')">Delete</button>
                        </form>
                    </td>
                @endcanany
            </tr>
        @empty
            <tr>
                <td colspan="3">No relationship types found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
