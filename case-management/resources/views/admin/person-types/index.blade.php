@extends('layouts.app')

@section('title', 'Person Types')

@section('content')
    <h1>Person Types</h1>
    <a href="{{ route('person-types.create') }}" class="btn btn-primary mb-3">Add New Type</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($types as $type)
                <tr>
                    <td>{{ $type->id }}</td>
                    <td>{{ $type->name }}</td>
                    <td>
                        <a href="{{ route('person-types.edit', $type) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('person-types.destroy', $type) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure you want to delete this type?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No person types found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
