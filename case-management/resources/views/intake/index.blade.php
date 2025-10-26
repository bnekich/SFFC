@php
    use App\Enums\Statuses\IntakeStatus as Status;
@endphp

@extends('layouts.app')

@section('title')
    - Intake
@endsection

@section('content')

@section('header')
    Intake
@endsection

<div class="flex justify-between items-center mb-4">
    <x-search :route="route('intake.index')" placeholder="Name or Summary" />

    <form class="mb-4" id="filterForm" method="GET" action="{{ route('intake.index') }}">
        <div>
            <label for="status" class="sr-only">Filter by Status</label>
            <select name="status" id="status"
                class="block  rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                onchange="document.getElementById('filterForm').submit()">
                <option value="">-- Filter by Status --</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status->value }}" {{ request('status') == $status->value ? 'selected' : '' }}>
                        {{ $status->label() }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>
    <div class="mb-4 inline-flex sffc-btn-primary">
        @can('intake-create')
            <a href="{{ route('intake.create') }}" class="sffc-btn-primary">Add Intake</a>
        @endcan
    </div>
</div>
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="sffc-table">
            <thead class="sffc-table-header">
                <tr>
                    <th scope="col" class="sffc-table-header-cell">
                        <a
                            href="{{ route('intake.index', array_merge(request()->query(), ['sort' => 'parent_name', 'direction' => request('sort') === 'parent_name' && request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                            Parent Name
                            @if (request('sort') === 'parent_name')
                                <i class="fas fa-arrow-{{ request('direction') === 'asc' ? 'up' : 'down' }}"></i>
                            @endif
                        </a>
                    </th>
                    <th scope="col" class="sffc-table-header-cell">Status</th>
                    <th scope="col" class="sffc-table-header-cell">Case Summary</th>
                    <th scope="col" class="sffc-table-header-cell">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($intakes as $intake)
                    <tr>
                        <td class="sffc-table-body-cell-primary">{{ $intake->parent_name }}</td>
                        <td class="sffc-table-body-cell">{{ $intake->intake_status }}</td>
                        <td class="sffc-table-body-cell-clipped">{{ $intake->case_summary }}</td>
                        <td class="sffc-table-body-cell-actions">
                            @can('intake-view')
                                <a href="{{ route('intake.show', $intake->id) }}" class="sffc-link-view">View</a>
                            @endcan
                            @can('intake-edit')
                                <a href="{{ route('intake.edit', $intake->id) }}" class="sffc-link-edit">Edit</a>
                            @endcan
                            @can('intakes-delete')
                                <x-delete-confirmation :route="route('intake.destroy', $intake)" :item-id="$intake->id"
                                    message="Are you sure you want to delete this intake?" />
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
    </div>
</div>
{{ $intakes->appends(request()->query())->links('') }}
@endsection
