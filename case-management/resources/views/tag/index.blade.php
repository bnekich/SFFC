<!-- resources/views/tags/index.blade.php -->
<xaiArtifact artifact_id="f61f0732-5ebe-4ece-9099-517046286cba" artifact_version_id="4e7c3b10-a903-4146-8bfb-8919a659fab0"
    title="tags/index.blade.php" contentType="text/html">
    @extends('layouts.app')

    @section('content')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Manage Tags</h3>
                            <a href="{{ route('tag.create') }}" class="btn btn-primary float-end">Create New Tag</a>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tags as $tag)
                                        <tr>
                                            <td>{{ $tag->name }}</td>
                                            <td>{{ $tag->created_at->format('Y-m-d H:i') }}</td>
                                            <td>
                                                <a href="{{ route('tag.edit', $tag->id) }}"
                                                    class="btn btn-sm btn-warning">Edit</a>
                                                <form action="{{ route('tag.destroy', $tag->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $tags->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
