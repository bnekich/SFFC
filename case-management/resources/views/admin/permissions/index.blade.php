@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
            @section('header')
                <h3 class="mb-4">Manage Permissions</h3>
            @endsection

            <a href="{{ route('permissions.create') }}" class="btn btn-primary mb-3">Create New Permission</a>

            <div class="card">
                <div class="card-body">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                        <a href="{{ route('permissions.edit', $permission) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('permissions.destroy', $permission) }}" method="POST"
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
