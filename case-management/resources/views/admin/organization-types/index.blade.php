@extends('layouts.app')

@section('title', 'Organization Types')

@section('content')
    <h1>Organization Types</h1>
    <a href="{{ route('organization-types.create') }}" class="btn btn-primary mb-3">Add New Type</a>
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
                            <a href="{{ route('organization-types.edit', $type) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('organization-types.destroy', $type) }}" method="POST" style="display:inline;">
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
                    <td colspan="3">No organization types found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
