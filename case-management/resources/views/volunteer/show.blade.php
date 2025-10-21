@extends('layouts.app')

@section('title')
    - View Volunteer
@endsection

@section('content')
    <div class="container mx-auto p-4">
    @section('header')
        Volunteer Details
    @endsection

    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-sm font-medium text-gray-700">Name</p>
                <p class="text-gray-900">{{ $volunteer->person->first_name }} {{ $volunteer->person->last_name }}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-700">County</p>
                <p class="text-gray-900">{{ $volunteer->county ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-700">Church</p>
                <p class="text-gray-900">{{ $volunteer->church->name ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-700">Volunteer Status</p>
                <p class="text-gray-900">{{ $volunteer->volunteerStatus->name ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-700">Created At</p>
                <p class="text-gray-900">{{ $volunteer->created_at->format('Y-m-d H:i:s') }}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-700">Updated At</p>
                <p class="text-gray-900">{{ $volunteer->updated_at->format('Y-m-d H:i:s') }}</p>
            </div>
        </div>
        <div class="mt-6 flex items-center gap-4">
            <a href="{{ route('volunteer.index') }}"
                class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Back</a>
            @can('volunteer-edit')
                <a href="{{ route('volunteer.edit', $volunteer) }}"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">Edit</a>
            @endcan
        </div>
    </div>
</div>
@endsection
