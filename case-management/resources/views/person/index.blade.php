@extends('layouts.app')

@section('title')
    - People
@endsection

@section('content')
@section('header')
    People
@endsection

<div class="flex justify-between items-center mb-4">
    <x-search :route="route('person.index', ['direction' => 'asc', 'sort' => 'last_name'])" placeholder="First Name or Last Name" />
    <form class="mb-4" id="filterForm" method="GET" action="{{ route('person.index') }}">
        <label for="organization" class="sr-only">Filter by Organization</label>
        <select name="organization" id="organization"
            class="block rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
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
    @can('person-create')
        <a href="{{ route('person.create') }}" class="sffc-btn-primary">Add
            Person</a>
    @endcan
</div>
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="table-auto w-full">
            <thead class="bg-blue-600 text-white uppercase text-sm leading50">
                <tr>
                    <th scope="col" class="sffc-table-header-cell">
                        <a
                            href="{{ route('person.index', array_merge(request()->query(), ['sort' => 'last_name', 'direction' => request('sort') === 'last_name' && request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                            Last Name
                            @if (request('sort') === 'last_name')
                                <i
                                    class="fas fa-arrow-{{ request('direction') === 'asc' || request('direction') === null ? 'up' : 'down' }}"></i>
                            @endif
                        </a>
                    </th>
                    <th scope="col" class="sffc-table-header-cell">
                        First
                        Name</th>
                    <th scope="col" class="sffc-table-header-cell">
                        Email
                    </th>
                    <th scope="col" class="sffc-table-header-cell">
                        Organization</th>
                    <th scope="col" class="sffc-table-header-cell">
                        Phone
                    </th>
                    <th scope="col" class="sffc-table-header-cell">
                        Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($persons as $person)
                    <tr class="hover:bg-gray-50">
                        <td class="sffc-table-body-cell">{{ $person->last_name }}</td>
                        <td class="sffc-table-body-cell">{{ $person->first_name }}</td>
                        <td class="sffc-table-body-cell">{{ $person->email }}</td>
                        <td class="sffc-table-body-cell max-w-xs overflow-hidden text-ellipsis whitespace-nowrap">
                            @if ($person->organizations->isNotEmpty())
                                {{ $person->organizations->pluck('name')->join(', ') }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="sffc-table-body-cell">{{ $person->phone }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            <a href="{{ route('person.show', $person) }}"
                                class="text-indigo-600 hover:text-indigo-900">View</a>
                            <a href="{{ route('person.edit', $person) }}"
                                class="text-yellow-600 hover:text-yellow-900">Edit</a>
                            @can('person-delete')
                                <x-delete-confirmation :route="route('person.destroy', $person)" :item-id="$person->id"
                                    message="Are you sure you want to delete this person?" />
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">No people found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4">
        {{ $persons->withQueryString()->links() }}
    </div>
</div>
@endsection
