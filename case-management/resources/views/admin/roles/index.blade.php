@extends('layouts.app')

@section('content')
    <div class="container">
    @section('header')
        <h3>Manage Roles</h3>
    @endsection
    <div class="row mb-3">
        @can('roles-create')
            <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">Create New Role</a>
        @endcan
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Role Type</th>
                    <th>Permissions</th>
                    @canany(['roles-create', 'roles-edit', 'roles-delete'])
                        <th>Actions</th>
                    @endcanany
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->role_type }}</td>
                        <td style="width: 50%">
                            @foreach ($role->permissions as $permission)
                                <span class="badge bg-primary">{{ $permission->name }}</span>
                            @endforeach
                        </td>
                        @canany(['roles-create', 'roles-edit', 'roles-delete'])
                            <td>
                                <a href="{{ route('roles.edit', $role) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('roles.destroy', $role) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        @endcanany
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
