@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1 class="mb-4">Manage Roles</h1>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">Create New Role</a>

                <div class="card">
                    <div class="card-body">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Permissions</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            @foreach ($role->permissions as $permission)
                                                <span class="badge bg-secondary">{{ $permission->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('roles.edit', $role) }}"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('roles.destroy', $role) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
