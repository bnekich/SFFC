@extends('layouts.app')
@section('title')
    - Organizations
@endsection

@section('content')
    <div class="container">
        <h3>Organizations</h3>
        <div class="row mb-3">
            <div class="col-md-6">
                <form method="GET" action="{{ route('organization.index') }}">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search for Organizations..."
                            value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
            @can('organizations-create')
                <div class="col-md-6">
                    <a href="{{ route('organization.create') }}" class="btn btn-primary mb-3">Add organization</a>
                </div>
            @endcan
        </div>
        <div class="table-responsive">
            <table class="table table-sm table-hover mt-3">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($organizations as $organization)
                        <tr>
                            <td>{{ $organization->name }} </td>
                            <td>{{ $organization->contactPerson->first_name . ' ' . $organization->contactPerson->last_name }}
                            </td>
                            <td>{{ $organization->contactPerson->email }}</td>
                            <td>{{ $organization->contactPerson->phone }}</td>
                            <td>
                                <a href="{{ route('organization.show', $organization) }}"
                                    class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('organization.edit', $organization) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                @can('organizations-delete')
                                    <form action="{{ route('organization.destroy', $organization) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $organizations->withQueryString()->links() }}
    </div>
@endsection
