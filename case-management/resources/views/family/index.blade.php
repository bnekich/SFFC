@extends('layouts.app')

@section('title')
    - Families
@endsection

@section('content')
@section('header')
    <h3 text-2xl font-bold>Families</h3>
@endsection

<div class="flex justify-between items-center mb-4">
    <x-search route="family.index" placeholder="Name" />
</div>

@can('family-create')
    <a href="{{ route('family.create') }}" class="sffc-btn-primary mb-4">Add Family</a>
@endcan

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="sffc-table mb-4">
            <thead class="sffc-table-header">
                <tr>
                    <th scope="col" class="sffc-table-header-cell"> <a
                            href="{{ route('family.index', array_merge(request()->query(), ['sort' => 'family_name', 'direction' => request('sort') === 'family_name' && request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                            Family Name
                            @if (request('sort') === 'family_name')
                                <i class="fas fa-arrow-{{ request('direction') === 'asc' ? 'up' : 'down' }}"></i>
                            @endif
                        </a>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase ">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($families as $family)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $family->family_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            @can('family-view')
                                <a href="{{ route('family.show', $family->id) }}"
                                    class="text-indigo-600 hover:text-indigo-900">View</a>
                            @endcan
                            @can('family-edit')
                                <a
                                    href="{{ route('family.edit', $family->id) }}"class="text-yellow-600 hover:text-yellow-900">Edit</a>
                            @endcan
                            @can('family-delete')
                                <x-delete-confirmation :route="route('family.destroy', $family)" :item-id="$family->id"
                                    message="Are you sure you want to delete this family?" />
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No families found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{ $families->withQueryString()->links() }}
</div>
@endsection
