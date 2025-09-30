@extends('layouts.app')

@section('title')
    - Notes
@endsection

@section('content')
    <div class="container">
    @section('header')
        <h3>Notes</h3>
    @endsection

    <x-search route="note.index" placeholder="Search by Title or Content" />
    <div class="row mb-3">
        <div class="col-auto align-items-end d-flex justify-content-end">
            @can('notes-create')
                <a href="{{ route('note.create') }}" class="btn btn-sm btn-primary">Add Note</a>
            @endcan
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-sm table-hover mt-3">
            <thead>
                <tr>
                    <th scope="col">
                        <a
                            href="{{ route('note.index', array_merge(request()->query(), ['sort' => 'title', 'direction' => request('sort') === 'title' && request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                            Title
                            @if (request('sort') === 'title')
                                <i class="fas fa-arrow-{{ request('direction') === 'asc' ? 'up' : 'down' }}"></i>
                            @endif
                        </a>
                    </th>
                    <th scope="col">Content</th>
                    <th scope="col">Attached To</th>
                    <th scope="col">Status</th>
                    <th scope="col" class="text-nowrap">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($notes as $note)
                    <tr>
                        <td>{{ $note->title }}</td>
                        <td class="cm-table-description">{{ Str::limit($note->note, 100) }}</td>
                        <td>
                            @if ($note->cases->isNotEmpty())
                                Cases: {{ $note->cases->pluck('case_identifier')->implode(', ') }}
                            @endif
                            @if ($note->volunteers->isNotEmpty())
                                <br>Volunteers: {{ $note->volunteers->pluck('name')->implode(', ') }}
                            @endif
                        </td>
                        <td>
                            <!-- Placeholder: Replace with NoteStatus model -->
                            <span
                                class="badge bg-{{ $note->note_status_id == 1 ? 'secondary' : ($note->note_status_id == 2 ? 'warning' : 'success') }}">
                                {{ $note->note_status_id == 1 ? 'Draft' : ($note->note_status_id == 2 ? 'Pending' : 'Approved') }}
                            </span>
                        </td>
                        <td class="d-flex flex-wrap gap-1 align-items-center">
                            @can('notes-view')
                                <a href="{{ route('note.show', $note->id) }}" class="btn btn-info btn-sm">View</a>
                            @endcan
                            @can('notes-edit')
                                <a href="{{ route('note.edit', $note->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            @endcan
                            @can('notes-delete')
                                <x-delete-confirmation :route="route('note.destroy', $note)" :item-id="$note->id"
                                    message="Are you sure you want to delete this note?" />
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No notes found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $notes->withQueryString()->links() }}
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection
