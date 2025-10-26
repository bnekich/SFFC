@extends('layouts.app')

@section('title')
    - Documents
@endsection

@section('content')
@section('header')
    Documents
@endsection
<div class="mb-4">
    <livewire:upload-document />
</div>
<div class="flex justify-between items-center mb-4">

    <x-search :route="route('document.index')" placeholder="Search Document Text" />
</div>
<!-- Documents Table -->
<table class="sffc-table">
    <thead class="sffc-table-header">
        <tr>
            <th scope="col" class="sffc-table-header-cell">Name</th>
            <th scope="col" class="sffc-table-header-cell">Type</th>
            <th scope="col" class="sffc-table-header-cell">Size</th>
            <th scope="col" class="sffc-table-header-cell">Uploaded</th>
            <th scope="col" class="sffc-table-header-cell-actions">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($documents as $document)
            <tr>
                <td>{{ $document->name }}</td>
                <td>{{ strtoupper($document->type) }}</td>
                <td>{{ round($document->size / 1024, 2) }} KB</td>
                <td>{{ $document->created_at->format('Y-m-d H:i') }}</td>
                <td>
                    <a href="{{ route('document.download', $document) }}" class="btn btn-sm btn-primary">Download</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">No documents found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<!-- Pagination -->
{{ $documents->links() }}
@endsection
