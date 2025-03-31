@extends('layouts.app')
@section('title')
    - People
@endsection

@section('content')
    <div class="container">
        <h3>Persons</h3>
        <div class="col-md-6">
            <form method="GET" action="{{ route('person.index') }}">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search for People..."
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>

        @can('person-create')
            <a href="{{ route('person.create') }}" class="btn btn-primary mb-3">Add Person</a>
        @endcan
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($persons as $person)
                    <tr>
                        <td>{{ $person->id }}</td>
                        <td>{{ $person->first_name }} </td>
                        <td>{{ $person->last_name }}</td>
                        <td>{{ $person->email }}</td>
                        <td>{{ $person->phone }}</td>
                        <td>
                            <a href="{{ route('person.show', $person) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('person.edit', $person) }}" class="btn btn-warning btn-sm">Edit</a>
                            @can('person-delete')
                                <form action="{{ route('person.destroy', $person) }}" method="POST" class="d-inline">
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
        {{ $persons->links() }}
    </div>
@endsection
