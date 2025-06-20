@extends('layouts.app')

@section('title')
    - People
@endsection

@section('content')
    <div class="container">
    @section('header')
        <h3>People</h3>
    @endsection
    <div class="row mb-3">
        <x-search route="person.index" placeholder="First Name or Last Name" />
        <div class="col-auto align-items-end d-flex justify-content-end">
            @can('person-create')
                <a href="{{ route('person.create') }}" class="btn btn-sm btn-primary">Add Person</a>
            @endcan
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-4">
            <form id="filterForm" method="GET" action="{{ route('person.index') }}">
                <select name="organization" class="form-control-sm"
                    onchange="document.getElementById('filterForm').submit()">
                    <option value="">-- Filter by Organization --</option>
                    @foreach ($organizations as $organization)
                        <option value="{{ $organization->id }}"
                            {{ request('organization') == $organization->id ? 'selected' : '' }}>
                            {{ $organization->name }}
                        </option>
                    @endforeach
                </select>
            </form>
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
                        <th scope="col">Organization</th>
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
                            <td>
                                @if ($person->organizations->isNotEmpty())
                                    {{ $person->organizations->pluck('name')->join(', ') }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ $person->phone }}</td>
                            <td>
                                <a href="{{ route('person.show', $person) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('person.edit', $person) }}" class="btn btn-warning btn-sm">Edit</a>
                                @can('persons-delete')
                                    <x-delete-confirmation :route="route('person.destroy', $person)" :item-id="$person->id"
                                        message="Are you sure you want to delete this person?" />
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
