@extends('layouts.app')

@section('title')
    - Intake
@endsection

@section('content')
    <div class="container">
        <h3>Intake</h3>
        <div class="row mb-3">
            <div class="col-8">
                <form id="searchForm" method="GET" action="{{ route('intake.index') }}">
                    <input id="searchBox" type="text" name="search" class="form-control-sm" placeholder="Search intakes..."
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-sm btn-primary">Search</button>
                    <button type="button" class="btn btn-sm btn-secondary" id="clearButton">Clear Search</button>
                </form>
            </div>
            <div class="col-auto align-items-end d-flex justify-content-end">
                @can('intake-create')
                    <a href="{{ route('intake.create') }}" class="btn btn-sm btn-primary">Add Intake</a>
                @endcan
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-sm table-hover mt-3">
                <thead>
                    <tr>
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
