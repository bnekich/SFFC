@extends('layouts.app')

@section('content')
    <div class="container">
    @section('header')
        <h3>Documents</h3>
    @endsection

    <!-- Search Form -->
    <form method="GET" action="{{ route('document.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="query" class="form-control" placeholder="Search document content..."
                value="{{ old('query', $query ?? '') }}">
            <button type="submit" class="btn btn-primary">Search</button>
            @if ($query)
                <a href="{{ route('document.index') }}" class="btn btn-secondary">Clear</a>
            @endif
        </div>
    </form>

    <!-- Documents Table -->
    <table class="table table-striped">
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
                        <a href="{{ route('document.download', $document) }}"
                            class="btn btn-sm btn-primary">Download</a>
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
