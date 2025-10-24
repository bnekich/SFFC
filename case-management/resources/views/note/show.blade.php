@extends('layouts.app')

@section('title')
    - View Note
@endsection

@section('content')
    <div class="container">
    @section('header')
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <h3>View Note</h3>
            </div>
            <div class="col-auto ms-auto">
                @can('notes-edit')
                    <a href="{{ route('note.edit', $note) }}" class="btn btn-warning btn-sm">Edit</a>
                @endcan
                @can('notes-delete')
                    <x-delete-confirmation :route="route('note.destroy', $note)" :item-id="$note->id"
                        message="Are you sure you want to delete this note?" />
                @endcan
                <a href="{{ route('note.index') }}" class="btn btn-secondary btn-sm">Back to Notes</a>
            </div>
        </div>
    @endsection

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $note->title }}</h5>
            <div class="mb-3">
                <strong>Content:</strong>
                <p>{{ $note->note }}</p>
            </div>
            @if ($note->comments)
                <div class="mb-3">
                    <strong>Comments:</strong>
                    <p>{{ $note->comments }}</p>
                </div>
            @endif
            <div class="mb-3">
                <strong>Privacy Level:</strong>
                <span>{{ $note->privacy->name }}</span>
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
    </div>
</div>
@endsection
