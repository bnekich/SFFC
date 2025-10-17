@extends('layouts.app')

@section('title')
    - Edit Volunteer
@endsection

@section('content')
    <div class="container mx-auto p-4">
    @section('header')
        <div class="mb-4">
            <h3 class="text-2xl font-bold">Edit {{ $volunteer->person->first_name }} {{ $volunteer->person->last_name }}</h3>
        </div>
    @endsection

    <form class="space-y-6" action="{{ route('volunteer.update', $volunteer) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <input class="hidden" name="person_id" value="{{ $volunteer->person->id }}">


            </div>
            <div>
                <label for="county" class="block text-sm font-medium text-gray-700">County</label>
                <input id="county" type="text" name="county" placeholder="County"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('county') is-invalid @enderror"
                    value="{{ old('county', $volunteer->county) }}">
                @error('county')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="church_id" class="block text-sm font-medium text-gray-700">Church</label>
                <select id="church_id" name="church_id"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('church_id') is-invalid @enderror">
                    <option value="">Select a Church</option>
                    @foreach ($churches as $church)
                        <option value="{{ $church->id }}"
                            {{ old('church_id', $volunteer->church_id) == $church->id ? 'selected' : '' }}>
                            {{ $church->name }}
                        </option>
                    @endforeach
                </select>
                @error('church_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="volunteer_status_id"
                    class="block text-sm font-medium text-gray-700 label-required">Volunteer Status</label>
                <select id="volunteer_status_id" name="volunteer_status_id"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('volunteer_status_id') is-invalid @enderror"
                    required>
                    <option value="">Select a Status</option>
                    @foreach ($volunteerStatuses as $status)
                        <option value="{{ $status->id }}"
                            {{ old('volunteer_status_id', $volunteer->volunteer_status_id) == $status->id ? 'selected' : '' }}>
                            {{ $status->name }}
                        </option>
                    @endforeach
                </select>
                @error('volunteer_status_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="flex items-center gap-4">
            <button type="submit"
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Update</button>
            <a href="{{ route('volunteer.index') }}"
                class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</a>
        </div>
    </form>
</div>
@endsection
