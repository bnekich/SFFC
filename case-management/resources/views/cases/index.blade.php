@extends('layouts.app')

@section('title')
    - Cases
@endsection

@section('content')
    <div class="container">
        <h3>Cases</h3>

        <!-- Search Form -->
        <div class="row mb-3">
            <div class="col-md-6">
                <form method="GET" action="{{ route('cases.index') }}">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search cases..."
                            value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                @can('cases-create')
                    <div class="col-md-6 text-end">
                        <a href="{{ route('cases.create') }}" class="btn btn-primary">Create New Case</a>
                    </div>
                @endcan
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover mt-3">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">
                            <a
                                href="{{ route('cases.index', array_merge(request()->query(), ['sort' => 'case_identifier', 'direction' => request('sort') === 'case_identifier' && request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                Case Identifier
                                @if (request('sort') === 'case_identifier')
                                    <i class="fas fa-arrow-{{ request('direction') === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </a>
                        </th>
                        <th scope="col">Case Description</th>
                        <th scope="col" class="text-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cases as $case)
                        <tr>
                            <td>{{ $case->id }}</td>
                            <td>{{ $case->case_identifier }}</td>
                            <td class="cm-table-description">{{ $case->case_description }}</td>
                            <td class="d-flex flex-wrap gap-1 align-items-center">
                                @can('cases-view')
                                    <a href="{{ route('cases.show', $case->id) }}" class="btn btn-info btn-sm">View</a>
                                @endcan
                                @can('cases-edit')
                                    <a href="{{ route('cases.edit', $case->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                @endcan
                                @can('cases-delete')
                                    <form class="d-inline" action="{{ route('cases.destroy', $case->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No cases found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $cases->appends(request()->query())->links('') }}
        </div>
    </div>
@endsection

@section('styles')
    <!-- Include Font Awesome for sort arrows if not already included -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection
