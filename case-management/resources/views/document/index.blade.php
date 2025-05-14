@extends('layouts.app')

@section('title')
    - Documents
@endsection

@section('content')
    <div class="container">
    @section('header')
        <h3>Documents</h3>
    @endsection
    <div class="row mb-3">
        <livewire:upload-document />
    </div>

    <div class="row mb-3">
        <x-search route="document.index" placeholder="Search Document Text" />
    </div>
    <!-- Documents Table -->
    <table class="table table-responsive">
        <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Size</th>
                <th>Uploaded</th>
                <th>Action</th>
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
</div>
@endsection
