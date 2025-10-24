@extends('layouts.app')

@section('title')
    - Notes
@endsection

@section('content')
@section('header')
    Notes
@endsection

<div class="flex justify-between items-center mb-4">
    <x-search route="note.index" placeholder="Search by Title or Content" />
</div>

@can('notes-create')
    <a href="{{ route('note.create') }}" class="sffc-btn-primary mb-4">Add Note</a>
@endcan

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="overflow-auto">
        <table class="sffc-table mb-4">
            <thead class="sffc-table-header">
                <tr>
                    <th scope="col" class="sffc-table-header-cell">
                        <a
                            href="{{ route('note.index', array_merge(request()->query(), ['sort' => 'title', 'direction' => request('sort') === 'title' && request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                            Title
                            @if (request('sort') === 'title')
                                <i class="fas fa-arrow-{{ request('direction') === 'asc' ? 'up' : 'down' }}"></i>
                            @endif
                        </a>
                    </th>
                    <th scope="col" class="sffc-table-header-cell">Content</th>
                    <th scope="col" class="sffc-table-header-cell">Attached To</th>
                    <th scope="col" class="sffc-table-header-cell">Status</th>
                    <th scope="col" class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($notes as $note)
                    <tr class="hover:bg-gray-50">
                        <td class="sffc-table-body-cell-primary">{{ $note->title }}</td>
                        <td class="sffc-table-body-cell">{{ Str::limit($note->note, 100) }}</td>
                        <td class="sffc-table-body-cell">
                            @if ($note->cases->isNotEmpty())
                                Cases: {{ $note->cases->pluck('case_identifier')->implode(', ') }}
                            @endif
                            @foreach ($note->volunteers as $volunteer)
                                <br />Volunteers: {{ $volunteer->person->first_name }}
                                {{ $volunteer->person->last_name }}
                            @endforeach
                        </td>
                        <td class="sffc-table-body-cell">
                            <button class="sffc-btn-badge-primary" type="button">
                                {{ $note->status->name }}
                            </button>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            @can('notes-view')
                                <a href="{{ route('note.show', $note->id) }}"
                                    class="text-indigo-600 hover:text-indigo-900">View</a>
                            @endcan
                            @can('notes-edit')
                                <a href="{{ route('note.edit', $note->id) }}"
                                    class="text-indigo-600 hover:text-yellow-900">Edit</a>
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
