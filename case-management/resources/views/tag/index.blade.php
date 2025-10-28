@extends('layouts.app')

@section('title')
    - Manage Tags
@endsection

@section('content')
@section('header')
    Tags
@endsection
<div class="flex justify-between items-center mb-4">
    <x-search :route="route('tag.index')" placeholder="Name" />
    @can('tag-create')
        <a href="{{ route('tag.create') }}" class="sffc-btn-primary">Create New Tag</a>
    @endcan
</div>
<table class="sffc-table">
    <thead class="sffc-table-header">
        <tr>
            <th scope="col" class="sffc-table-header-cell">Name</th>
            <th scope="col" class="sffc-table-header-cell">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tags as $tag)
            <tr>
                <td class="sffc-table-body-cell">{{ $tag->name }}</td>
                <td class="sffc-table-body-cell"> <a href="{{ route('tag.edit', $tag->id) }}" class="sffc-link-edit">
                        Edit</a>
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
