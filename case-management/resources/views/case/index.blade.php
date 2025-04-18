@php
    use App\Enums\Statuses\CaseStatus as Status;
@endphp

@extends('layouts.app')

@section('title')
    - Cases
@endsection

@section('content')
    <div class="container">
        <h3>Cases</h3>
        <div class="row mb-3">
            <div class="col-8">
                <form id="searchForm" method="GET" action="{{ route('case.index') }}">
                    <input id="searchBox" type="text" name="search" class="form-control-sm" placeholder="Search cases..."
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-sm btn-primary">Search</button>
                    <button type="button" class="btn btn-sm btn-secondary" id="clearButton">Clear Search</button>
                </form>
            </div>
            <div class="col-auto align-items-end d-flex justify-content-end">
                @can('cases-create')
                    <a href="{{ route('case.create') }}" class="btn btn-sm btn-primary">Add Case</a>
                @endcan
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-4">
                <form id="filterForm" method="GET" action="{{ route('case.index') }}">
                    <select name="status" class="form-control-sm"
                        onchange="document.getElementById('filterForm').submit()">
                        <option value="">-- Filter by Status --</option>
                        @foreach ($statuses as $status)
                            <option value="{{ $status->value }}"
                                {{ request('status') == $status->value ? 'selected' : '' }}>
                                {{ $status->label() }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-sm table-hover mt-3">
                <thead>
                    <tr>
                        <th scope="col">
                            <a
                                href="{{ route('case.index', array_merge(request()->query(), ['sort' => 'case_identifier', 'direction' => request('sort') === 'case_identifier' && request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                Case Identifier
                                @if (request('sort') === 'case_identifier')
                                    <i class="fas fa-arrow-{{ request('direction') === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </a>
                        </th>
                        <th scope="col">Status</th>
                        <th scope="col">Case Description</th>
                        <th scope="col" class="text-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cases as $case)
                        <tr>
                            <td>{{ $case->case_identifier }}</td>
                            <td>
                                @switch ($case->status)
                                    @case(Status::Open->value)
                                        <span class="badge bg-success">{{ Status::Open->label() }}</span>
                                    @break

                                    @case(Status::OnHold->value)
                                        <span class="badge bg-warning">{{ Status::OnHold->label() }}</span>
                                    @break

                                    @case(Status::Closed->value)
                                        <span class="badge bg-danger">{{ Status::Closed->label() }}</span>
                                    @break

                                    @case(Status::Cancelled->value)
                                        <span class="badge bg-danger">{{ Status::Cancelled->label() }}</span>
                                    @break

                                    @default
                                        <span class="badge bg-danger">{{ $case->status }}</span>
                                @endswitch
                            </td>
                            <td class="cm-table-description">{{ $case->case_description }}</td>
                            <td class="d-flex flex-wrap gap-1 align-items-center">
                                @can('cases-view')
                                    <a href="{{ route('case.show', $case->id) }}" class="btn btn-info btn-sm">View</a>
                                @endcan
                                @can('cases-edit')
                                    <a href="{{ route('case.edit', $case->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                @endcan
                                @can('cases-delete')
                                    <form class="d-inline" action="{{ route('case.destroy', $case->id) }}" method="POST">
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
                {{ $cases->withQueryString()->links() }}
            </div>
        </div>
    @endsection

    @section('styles')
        <!-- Include Font Awesome for sort arrows if not already included -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @endsection
