@extends('layouts.app')

@section('title', 'Relationship Types')

@section('content')
    <h1>Relationship Types</h1>
    @can('types-create')
        <a href="{{ route('relationship-types.create') }}" class="btn btn-primary mb-3">Add New Type</a>
    @endcan
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                @canany('types-create', 'types-edit', 'types-delete')
                    <th>Actions</th>
                @endcanany
            </tr>
        </thead>
        <tbody>
            @forelse($types as $type)
                <tr>
                    <td>{{ $type->id }}</td>
                    <td>{{ $type->name }}</td>
                    @canany('types-create', 'types-edit', 'types-delete')
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
