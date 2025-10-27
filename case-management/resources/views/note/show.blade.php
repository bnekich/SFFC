@php
    use App\Models\User;
@endphp

@extends('layouts.app')

@section('title')
    - View Note
@endsection

@section('content')
@section('header')
    <div class="col-auto">
        <h3>View Note</h3>
    </div>
@endsection

<div class="flex justify-end space-x-4">
    <a href="{{ route('note.index') }}" class="sffc-link-primary">Back to Notes</a>
    @can('notes-edit')
        <a href="{{ route('note.edit', $note) }}" class="sffc-link-edit">Edit</a>
    @endcan
    @can('notes-delete')
        <x-delete-confirmation :route="route('note.destroy', $note)" :item-id="$note->id" message="Are you sure you want to delete this note?" />
    @endcan
</div>
<div class="container mx-auto p-4">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="px-4 py-5 sm:px-6">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-xl leading-6 font-semibold text-gray-900">
                        {{ $note->title }}
                    </h3>
                    {{-- <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Personal details and contact information.
                    </p> --}}
                </div>
                {{-- <div class="flex items-center gap-4 print:hidden">
                    <a href="{{ route('person.edit', $person) }}"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">Edit</a>
                    <a href="{{ route('person.index') }}"
                        class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Back
                        to List</a>
                </div> --}}
            </div>
        </div>
    </div>
</div>
<div class="border-t border-gray-200 px-4 py-5 sm:p-0">
    <dl class="sm:divide-y sm:divide-gray-200">
        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Note Content</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $note->note }}</dd>
        </div>
        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Comments</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $note->comments ?? 'No comments' }}</dd>
        </div>
        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Note Privacy and Status</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ $note->privacy->name }} <br>
                {{ $note->status->name }}
            </dd>
        </div>
        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Tags</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                @if ($note->tags->isNotEmpty())
                    {{ $note->tags->pluck('name')->join(', ') }}
                @else
                    None
                @endif
            </dd>
        </div>
        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Attached Cases</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                @if ($note->cases->isNotEmpty())
                    {{ $note->cases->pluck('case_identifier')->join(', ') }}
                @else
                    None
                @endif
            </dd>
        </div>
        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Attached Volunteers</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                @forelse ($note->volunteers as $volunteer)
                    <li>{{ $volunteer->person->first_name }} {{ $volunteer->person->last_name }}</li>
                @empty
                    None
                @endforelse
            </dd>
        </div>
        {{-- <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Audit Info</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                <div class="mb-3">
                    <strong>Created By:</strong>
                    <span>{{ User::find($note->created_by)->name ?? 'User #' . $note->created_by }}</span>
                </div>
                <div class="mb-3">
                    {{-- <strong>Updated By:</strong>
                    <span>{{ $note->updated_by ? \App\Models\User::find($note->updated_by)->name ?? 'User #' . $note->updated_by : 'Unknown' }}</span>
                </div>
                <div class="mb-3">
                    {{-- <strong>Created At:</strong>
                    <span>{{ $note->created_at->format('Y-m-d H:i:s') }}</span>
                </div>
                <div class="mb-3">
                    {{-- <strong>Updated At:</strong>
                    <span>{{ $note->updated_at->format('Y-m-d H:i:s') }}</span>
                </div>
            </dd>
        </div> --}}

    </dl>
</div>
{{-- <div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $note->title }}</h5>
        <div class="mb-3">
            <strong>Content:</strong>
            <p>{{ $note->note }}</p>
        </div>
        @if ($note->comments)
            <div class="mb-3">
                <strong>Comments:</strong>
                <p>{{ $note->comments ?? 'No comments' }}</p>
            </div>
        @endif
        <div class="mb-3">
            <strong>Privacy Level:</strong>
            <span>{{ $note->privacy->name ?? 'Not Set' }}</span>
        </div>
        <div class="mb-3">
            <strong>Status:</strong>
            <span> {{ $note->status->name }} </span>
        </div>
        <div class="mb-3">
            <strong>Approved:</strong>
            <span>{{ $note->approved ? 'Yes' : 'No' }}</span>
        </div>
        <div class="mb-3">
            <strong>Attached Cases:</strong>
            @if ($note->cases->isNotEmpty())
                <ul>
                    @foreach ($note->cases as $case)
                        <li>{{ $case->case_identifier }}</li>
                    @endforeach
                </ul>
            @else
                <p>None</p>
            @endif
        </div>
        <div class="mb-3">
            <strong>Attached Volunteers:</strong>
            @if ($note->volunteers->isNotEmpty())
                <ul>
                    @foreach ($note->volunteers as $volunteer)
                        <li>{{ $volunteer->person->first_name }} {{ $volunteer->person->last_name }}</li>
                    @endforeach
                </ul>
            @else
                <p>None</p>
            @endif
        </div>
        <div class="mb-3">
            <strong>Created By:</strong>
            <span>{{ $note->created_by ? \App\Models\User::find($note->created_by)->name ?? 'User #' . $note->created_by : 'Unknown' }}</span>
        </div>
        <div class="mb-3">
            <strong>Updated By:</strong>
            <span>{{ $note->updated_by ? \App\Models\User::find($note->updated_by)->name ?? 'User #' . $note->updated_by : 'Unknown' }}</span>
        </div>
        <div class="mb-3">
            <strong>Created At:</strong>
            <span>{{ $note->created_at->format('Y-m-d H:i:s') }}</span>
        </div>
        <div class="mb-3">
            <strong>Updated At:</strong>
            <span>{{ $note->updated_at->format('Y-m-d H:i:s') }}</span>
        </div>
    </div>
</div> --}}
@endsection
