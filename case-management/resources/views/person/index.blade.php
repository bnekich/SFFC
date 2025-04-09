@extends('layouts.app')

@section('title')
    - People
@endsection

@section('content')
    <div class="container">
        <h3>People</h3>
        <div class="row mb-3">
            <div class="col-8">
                <form id="searchForm" method="GET" action="{{ route('person.index') }}">
                    <input id="searchBox" type="text" name="search" class="form-control-sm"
                        placeholder="Search for People..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-sm btn-primary">Search</button>
                    <button type="button" class="btn btn-sm btn-secondary" id="clearButton">Clear Search</button>
                </form>
            </div>
            <div class="col-auto align-items-end d-flex justify-content-end">
                @can('person-create')
                    <a href="{{ route('person.create') }}" class="btn btn-sm btn-primary">Add Person</a>
                @endcan
            </div>
        </div>
        <div class="row mb-3">
            <div class="table-responsive">
                <table class="table table-sm table-hover mt-3">
                    <thead>
                        <tr>
                            {{-- <th scope="col">ID</th> --}}
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($persons as $person)
                            <tr>
                                {{-- <td>{{ $person->id }}</td> --}}
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
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No people found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $persons->withQueryString()->links() }}
            </div>
        </div>
    @endsection
