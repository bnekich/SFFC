@php
    use App\Enums\Statuses\CaseStatus as Status;
@endphp

@extends('layouts.app')

@section('title')
    - Cases
@endsection

@section('content')

@section('header')
    <h3>Cases</h3>
@endsection

<x-search route="case.index" placeholder="Identifier or Description" />
<div class="row mb-3">
    <div class="col-auto">
        <form id="filterForm" method="GET" action="{{ route('case.index') }}">
            <select name="status" class="form-control-sm" onchange="document.getElementById('filterForm').submit()">
                <option value="">-- Filter by Status --</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status->id }}" {{ request('status') == $status->id ? 'selected' : '' }}>
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>
            <div class="form-check form-switch">
                <input type="hidden" name="user_id" value="0">
                <input type="checkbox" name="user_id" value="1" class="form-check-input"
                    onchange="document.getElementById('filterForm').submit()" {{ request('user_id') ? 'checked' : '' }}>
                <label class="form-check-label">Show
                    Assigned Cases</label>
            </div>
        </form>
    </div>
    <div class="col-auto align-items-end d-flex justify-content-end">
        @can('case-create')
            <a href="{{ route('case.create') }}" class="btn btn-sm btn-primary">Add Case</a>
        @endcan
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
                        @switch ($case->caseStatus->name)
                            @case('Open')
                                <span class="badge bg-success">Open</span>
                            @break

                            @case('On Hold')
                                <span class="badge bg-warning">On Hold</span>
                            @break

                            @case('Closed')
                                <span class="badge bg-danger">Closed</span>
                            @break

                            @case('Cancelled')
                                <span class="badge bg-danger">Cancelled</span>
                            @break

                            @default
                                <span class="badge bg-danger">{{ $case->caseStatus->name }}</span>
                        @endswitch
                    </td>
                    <td class="cm-table-description">{{ $case->case_description }}</td>
                    <td class="d-flex flex-wrap gap-1 align-items-center">
                        @can('case-view')
                            <a href="{{ route('case.show', $case->id) }}" class="btn btn-info btn-sm">View</a>
                        @endcan
                        @can('case-edit')
                            <a href="{{ route('case.edit', $case->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        @endcan
                        @can('case-delete')
                            <x-delete-confirmation :route="route('case.destroy', $case)" :item-id="$case->id"
                                message="Are you sure you want to delete this case?" />
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
@endsection
