@extends('layouts.app')

@section('header')
    <h3 class="text-2xl font-bold">Organization Details</h3>
@endsection

@section('content')
    <div class="container mx-auto p-4">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-4 py-5 sm:px-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-xl leading-6 font-semibold text-gray-900">
                            {{ $organization->name }} ({{ $organization->organizationType->name ?? 'N/A' }})
                        </h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                            Organization details and contact information.
                        </p>
                    </div>
                    <div class="flex items-center gap-4 print:hidden">
                        <a href="{{ route('organization.edit', $organization) }}"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">Edit</a>
                        <a href="{{ route('organization.index') }}"
                            class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Back
                            to List</a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Name</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $organization->name }}</dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Address</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $organization->address?->address_line_1 ?? '' }} <br>
                            {{ $organization->address?->address_line_2 ? $organization->address->address_line_2 . ',' : '' }}
                            <br>
                            {{ $organization->address?->city ?? '' }}, {{ $organization->address?->state ?? '' }}
                            {{ $organization->address?->zip ?? '' }}
                        </dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Contact Information</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $organization->contact_person_name ?? 'N/A' }} <br>
                            {{ $organization->contact_person_title ?? 'N/A' }} <br>
                            {{ $organization->contact_person_email ?? 'N/A' }} <br>
                            {{ $organization->contact_person_phone ?? 'N/A' }}
                            {{ $organization->contact_person_mobile ?? 'N/A' }}
                        </dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Associated People</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            @foreach ($organization->persons as $person)
                                {{ $person->last_name . ', ' . $person->first_name }}<br>
                            @endforeach
                        </dd>
                    </div>
            </div>
        </div>
    @endsection
