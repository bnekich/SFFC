@extends('layouts.app')

@section('title')
    - Volunteers
@endsection

@section('content')
@section('header')
    Volunteers
@endsection

<div class="flex justify-between items-center mb-4">
    <x-search :route="route('volunteer.index')" placeholder="Search Volunteers by Name" />
</div>

<form class="mb-4" id="filterForm" method="GET" action="{{ route('volunteer.index') }}">
    <label for="volunteer_status" class="sr-only">Filter by Status</label>
    <select name="volunteer_status" id="volunteer_status" class="sffc-text-input"
        onchange="document.getElementById('filterForm').submit()">
        <option value="">-- Filter by Status --</option>
        @foreach ($volunteerStatuses as $status)
            <option value="{{ $status->id }}" {{ request('volunteer_status') == $status->id ? 'selected' : '' }}>
                {{ $status->name }}
            </option>
        @endforeach
    </select>
</form>

@can('volunteer-create')
    <a href="{{ route('volunteer.create') }}" class="mb-4 inline-flex sffc-btn-primary">Add Volunteer</a>
@endcan

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-blue-600">
            <thead class="sffc-table-header">
                <tr>
                    <th scope="col" class="sffc-table-header-cell">Name</th>
                    <th scope="col" class="sffc-table-header-cell">County</th>
                    <th scope="col" class="sffc-table-header-cell">Church</th>
                    <th scope="col" class="sffc-table-header-cell">Status</th>
                    <th scope="col" class="sffc-table-header-cell">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($volunteers as $volunteer)
                    <tr class="hover:bg-gray-50">
                        <td class="sffc-table-body-cell-primary">
                            {{ $volunteer->person->first_name }} {{ $volunteer->person->last_name }}
                        </td>
                        <td class="sffc-table-body-cell">{{ $volunteer->county ?? 'N/A' }}
                        </td>
                        <td class="sffc-table-body-cell">
                            {{ $volunteer->church->name ?? 'N/A' }}
                        </td>
                        <td class="sffc-table-body-cell">
                            {{ $volunteer->volunteerStatus->name ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            <a href="{{ route('note.create', ['person_id' => $volunteer->person->id]) }}"
                                class="text-indigo-600 hover:text-indigo-900">Add Note</a>
                            <a href="{{ route('volunteer.show', $volunteer) }}"
                                class="text-indigo-600 hover:text-indigo-900">View</a>
                            <a href="{{ route('volunteer.edit', $volunteer) }}"
                                class="text-yellow-600 hover:text-yellow-900">Edit</a>
                            @can('volunteer-delete')
                                <x-delete-confirmation :route="route('volunteer.destroy', $volunteer)" :item-id="$volunteer->id"
                                    message="Are you sure you want to delete this volunteer?" />
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No volunteers found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4">
        {{ $volunteers->withQueryString()->links() }}
    </div>
</div>
@endsection
