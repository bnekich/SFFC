@extends('layouts.app') <!-- Assuming you have a layout -->

@section('content')
    <h3>Manage Users</h3>
    @can('users-create')
        <a href="{{ route('users.create') }}" class="btn btn-primary">Add User</a>
    @endcan
    <div class="table-responsive">
        <table class="table table-hover mt-3">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    @can('users-update|users-delete')
                        <th scope="col" class="text-nowrap">Actions</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->firstName . ' ' . $user->lastName }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @can('users-update')
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning">Edit</a>
                            @endcan
                            @can('users-delete')
                                <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if (session('temp_password'))
        <p>Temporary Password: {{ session('temp_password') }} (Share this securely with the user)</p>
    @endif
@endsection
