@extends('layouts.app')

@section('content')
    <div class="container">
    @section('header')
        Manage Roles
    @endsection
    <div class="row mb-3">
        @can('role-create')
            <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">Create New Role</a>
        @endcan
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Role Type</th>
                    <th>Permissions</th>
                    @canany(['role-create', 'role-edit', 'role-delete'])
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
                        @canany(['role-create', 'role-edit', 'role-delete'])
                            <td>
                                <a href="{{ route('roles.edit', $role) }}" class="btn btn-sm btn-warning">Edit</a>
                                @can('role-delete')
                                    <x-delete-confirmation :route="route('roles.destroy', $role)" :item-id="$role->id"
                                        message="Are you sure you want to delete this role?" />
                                @endcan
                            </td>
                        @endcanany
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
