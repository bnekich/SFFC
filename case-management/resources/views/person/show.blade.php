@extends('layouts.app')

@section('header')
    <h3 class="text-2xl font-bold">Person Details</h3>
@endsection

@section('content')
    <div class="container mx-auto p-4">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="px-4 py-5 sm:px-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-xl leading-6 font-semibold text-gray-900">
                            {{ $person->first_name }} {{ $person->last_name }}
                        </h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                            Personal details and contact information.
                        </p>
                    </div>
                    <div class="flex items-center gap-4 print:hidden">
                        <a href="{{ route('person.edit', $person) }}"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">Edit</a>
                        <a href="{{ route('person.index') }}"
                            class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Back
                            to List</a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Full Name</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $person->first_name }}
                            {{ $person->middle_name }} {{ $person->last_name }}</dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Email address</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $person->email ?? 'N/A' }}</dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Phone Number</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $person->phone ?? 'N/A' }}</dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Address</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $person->address?->address_line_1 ?? '' }}<br>
                            {{ $person->address?->address_line_2 ? $person->address->address_line_2 . ',' : '' }}
                            {{ $person->address?->city ?? '' }}, {{ $person->address?->state ?? '' }}
                            {{ $person->address?->zip ?? '' }}
                        </dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Reminders</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            Can receive text reminders: {{ $person->can_text_reminder ? 'Yes' : 'No' }}<br>
                            Can receive email reminders: {{ $person->can_email_reminder ? 'Yes' : 'No' }}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
@endsection
