@extends('layouts.app')

@section('title')
    - Organizations
@endsection

@section('content')
@section('header')
    Organizations
@endsection
<div class="flex justify-between items-center mb-4">
    <x-search :route="route('organization.index')" placeholder="Organization or Contact" />
    <div class="col-auto align-items-end d-flex justify-content-end">
        @can('organization-create')
            <a href="{{ route('organization.create') }}" class="sffc-btn-primary">Add Organization</a>
        @endcan
    </div>
</div>
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="sffc-table">
            <thead class="sffc-table-header">
                <tr>
                    <th scope="col" class="sffc-table-header-cell">Name</th>
                    <th scope="col" class="sffc-table-header-cell">Contact</th>
                    <th scope="col" class="sffc-table-header-cell">Title</th>
                    <th scope="col" class="sffc-table-header-cell">Phone</th>
                    <th scope="col" class="sffc-table-header-cell">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($organizations as $organization)
                    <tr class="hover:bg-gray-50">
                        <td class="sffc-table-body-cell-primary">{{ $organization->name }} </td>
                        <td class="sffc-table-bocy-cell">{{ $organization->contact_person_name }}</td>
                        <td class="cm-table-description">{{ $organization->contact_person_title }}</td>
                        <td class="sffc-table-body-cell">{{ $organization->contact_person_phone }}</td>
                        <td class="sffc-table-body-cell-actions">
                            <a href="{{ route('organization.show', $organization) }}" class="sffc-link-view">View</a>
                            <a href="{{ route('organization.edit', $organization) }}" class="sffc-link-edit">Edit</a>
                            @can('organization-delete')
                                <x-delete-confirmation :route="route('organization.destroy', $organization)" :item-id="$organization->id"
                                    message="Are you sure you want to delete this organization?" />
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{{ $organizations->withQueryString()->links() }}
@endsection
