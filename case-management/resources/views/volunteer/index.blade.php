@extends('layouts.app')

@section('title')
    - Volunteers
@endsection

@section('content')
@section('header')
    <h3 class="text-2xl font-bold">Volunteers</h3>
@endsection

<div class="flex justify-between items-center mb-4">
    <x-search route="volunteer.index" placeholder="Search Volunteers by Name" />
</div>

<form class="mb-4" id="filterForm" method="GET" action="{{ route('volunteer.index') }}">
    <label for="volunteer_status" class="sr-only">Filter by Status</label>
    <select name="volunteer_status" id="volunteer_status"
        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
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
            <thead class="bg-blue-600 text-white uppercase text-sm leading-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase">Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase">County</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase">Church</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($volunteers as $volunteer)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $volunteer->person->first_name }} {{ $volunteer->person->last_name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $volunteer->county ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $volunteer->church->name ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $volunteer->volunteerStatus->name ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
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
