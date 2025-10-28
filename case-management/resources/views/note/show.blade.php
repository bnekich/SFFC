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
    <div class="bg-white shadow rounded overflow-hidden">
        <div class="px-3 py-3 sm:px-6">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-xl leading-6 font-semibold text-gray-900">
                        {{ $note->title }}
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="border-t border-gray-200 px-4 py-2 sm:p-0">
    <dl class="sm:divide-y sm:divide-gray-200">
        <div class="py-2 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Note Content</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $note->note }}</dd>
        </div>
        <div class="py-2 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Comments</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $note->comments ?? 'No comments' }}</dd>
        </div>
        <div class="py-2 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Note Privacy and Status</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ $note->privacy->name }} <br>
                {{ $note->status->name }}
            </dd>
        </div>
        <div class="py-2 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Tags</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                @forelse ($note->tags as $tag)
                    <li>{{ $tag->name }}</li>
                @empty
                    None
                @endforelse
            </dd>
        </div>
        <div class="py-2 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Attached Cases</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                @forelse ($note->cases as $case)
                    <li>{{ $case->case_identifier }}</li>
                @empty
                    None
                @endforelse
            </dd>
        </div>
        <div class="py-2 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Attached Volunteers</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                @forelse ($note->volunteers as $volunteer)
                    <li>{{ $volunteer->person->first_name }} {{ $volunteer->person->last_name }}</li>
                @empty
                    None
                @endforelse
            </dd>
        </div>
        <div class="py-2 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Audit Info</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                <div class="mb-3">
                    <strong>Created By:</strong>
                    <span>
                        {{ User::find($note->created_by)->fullName() ?? 'User #' . $note->created_by }}
                        on
                        {{ $note->created_at->format('m-d-Y H:i:s') }}
                    </span>
                </div>
                <div class="mb-3">
                    <strong>Updated By:</strong>
                    <span>{{ User::find($note->updated_by)->fullName() ?? 'User #' . $note->updated_by }} on
                        {{ $note->updated_at->format('m-d-Y H:i:s') }}</span>
                </div>
            </dd>
        </div>
    </dl>
</div>

{{-- <div class="mb-3">
    <strong>Approved:</strong>
    <span>{{ $note->approved ? 'Yes' : 'No' }}</span>
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
