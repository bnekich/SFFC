@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Intake</h3>

        <!-- Search Form -->
        <div class="row mb-3">
            <div class="col-md-6">
                <form method="GET" action="{{ route('intake.index') }}">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search intakes..."
                            value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                @can('intake-create')
                    <div class="col-md-6 text-end">
                        <a href="{{ route('intake.create') }}" class="btn btn-primary">Create Intake</a>
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
                                href="{{ route('intake.index', array_merge(request()->query(), ['sort' => 'parent_name', 'direction' => request('sort') === 'parent_name' && request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                Parent Name
                                @if (request('sort') === 'parent_name')
                                    <i class="fas fa-arrow-{{ request('direction') === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </a>
                        </th>
                        <th scope="col">Case Summary</th>
                        <th scope="col" class="text-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($intakes as $intake)
                        <tr>
                            <td>{{ $intake->id }}</td>
                            <td>{{ $intake->parent_name }}</td>
                            <td class="cm-table-description">{{ $intake->case_summary }}</td>
                            <td class="d-flex flex-wrap gap-1 align-items-center">
                                @can('intake-view')
                                    <a href="{{ route('intake.show', $intake->id) }}" class="btn btn-info btn-sm">View</a>
                                @endcan
                                @can('intake-edit')
                                    <a href="{{ route('intake.edit', $intake->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                @endcan
                                @can('intake-delete')
                                    <form class="d-inline" action="{{ route('intake.destroy', $intake->id) }}" method="POST">
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
            {{ $intakes->appends(request()->query())->links('') }}
        </div>
    </div>
@endsection

@section('styles')
    <!-- Include Font Awesome for sort arrows if not already included -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection
