@extends('layouts.app') <!-- Assuming you have a layout -->

@section('content')
    <div class="container">
    @section('header')
        <h3>Manage Users</h3>
    @endsection
    @can('users-create')
        <a href="{{ route('users.create') }}" class="btn btn-primary">Add User</a>
    @endcan
    <div class="table-responsive">
        <table class="table table-sm table-hover mt-3">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    @canany(['users-create', 'users-edit', 'users-delete'])
                        <th scope="col" class="text-nowrap">Actions</th>
                    @endcanany
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->firstName . ' ' . $user->lastName }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @canany(['users-create', 'users-edit', 'users-delete'])
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning">Edit</a>
                            @endcanany
                            @can('users-delete')
                                <x-delete-confirmation :route="route('users.destroy', $user)" :item-id="$user->id"
                                    message="Are you sure you want to delete this user?" />
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
</div>
@endsection
