@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-4">Manage Roles</h3>

        <div class="row mb-3">
            @can('roles-create')
                <div class="col-md-6">
                    <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">Create New Role</a>
                </div>
            @endcan
        </div>
        <div class="table-responsive">
            <table class="table table-hover mt-3">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Permissions</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td style="width: 50%">
                                @foreach ($role->permissions as $permission)
                                    <span class="badge bg-primary">{{ $permission->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-md-2">
                                        @can('roles-edit')
                                            <a href="{{ route('roles.edit', $role) }}" class="btn btn-sm btn-warning">Edit</a>
                                        @endcan
                                    </div>
                                    <div class="col-md-6">
                                        @can('roles-delete')
                                            <form action="{{ route('roles.destroy', $role) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection
