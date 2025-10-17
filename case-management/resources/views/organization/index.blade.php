@extends('layouts.app')
@section('title')
    - Organizations
@endsection

@section('content')
    <div class="container">
    @section('header')
        <h3>Organizations</h3>
    @endsection
    <div class="row mb-3">
        <x-search route="organization.index" placeholder="Organization or Contact" />
        <div class="col-auto align-items-end d-flex justify-content-end">
            @can('organization-create')
                <a href="{{ route('organization.create') }}" class="btn btn-sm btn-primary mb-3">Add Organization</a>
            @endcan
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-sm table-hover mt-3">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Title</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($organizations as $organization)
                    <tr>
                        <td>{{ $organization->name }} </td>
                        <td>{{ $organization->contact_person_name }}</td>
                        <td class="cm-table-description">{{ $organization->contact_person_title }}</td>
                        <td>{{ $organization->contact_person_phone }}</td>
                        <td>
                            <a href="{{ route('organization.show', $organization) }}"
                                class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('organization.edit', $organization) }}"
                                class="btn btn-warning btn-sm">Edit</a>
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
    {{ $organizations->withQueryString()->links() }}
</div>
@endsection
