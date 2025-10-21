@extends('layouts.app')

@section('title')
    - Manage Tags
@endsection

@section('content')
@section('header')
    Tags
@endsection
<div class="row mb-3">
    <x-search route="tag.index" placeholder="Name" />
    @can('tag-create')
        <div class="col-auto align-items-end d-flex justify-content-end">
            <a href="{{ route('tag.create') }}" class="btn btn-sm btn-primary">Create New Tag</a>
        </div>
    @endcan
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tags as $tag)
            <tr>
                <td>{{ $tag->name }}</td>
                <td>
                    <a href="{{ route('tag.edit', $tag->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <x-delete-confirmation :route="route('tag.destroy', $tag)" :item-id="$tag->id"
                        message="Are you sure you want to delete this tag?" />
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $tags->links() }}
</div>
@endsection
