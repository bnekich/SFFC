@extends('layouts.app') <!-- Assuming you have a layout -->

@section('content')
    <h1>Manage Users</h1>
    {{-- <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Add User</a> --}}
    <a href="{{ route('users.create') }}" class="btn btn-primary">Add User</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
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
    @if (session('temp_password'))
        <p>Temporary Password: {{ session('temp_password') }} (Share this securely with the user)</p>
    @endif
    @if (session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif <!-- Add your dashboard content here -->
@endsection
