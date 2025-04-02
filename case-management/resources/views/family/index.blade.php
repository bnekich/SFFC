@extends('layouts.app')
@section('title')
    - Families
@endsection

@section('content')
    <div class="container">
        <h3>Families</h3>
        <div class="row mb-3">
            <div class="col-md-6">
                <form method="GET" action="{{ route('family.index') }}">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search families..."
                            value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                @can('families-create')
                    <div class="col-md-6 text-end">
                        <a href="{{ route('family.create') }}" class="btn btn-primary">Create Family</a>
                    </div>
                @endcan
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover mt-3">
                <thead>
                    <tr>
                        <th scope="col">
                            <a
                                href="{{ route('family.index', array_merge(request()->query(), ['sort' => 'family_name', 'direction' => request('sort') === 'family_name' && request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                Family Name
                                @if (request('sort') === 'family_name')
                                    <i class="fas fa-arrow-{{ request('direction') === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </a>
                        </th>
                        <th scope="col" class="text-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($families as $family)
                        <tr>
                            <td>{{ $family->family_name }}</td>
                            <td class="d-flex flex-wrap gap-1 align-items-center">
                                @can('families-view')
                                    <a href="{{ route('family.show', $family->id) }}" class="btn btn-info btn-sm">View</a>
                                @endcan
                                @can('families-edit')
                                    <a href="{{ route('family.edit', $family->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                @endcan
                                @can('families-delete')
                                    <form class="d-inline" action="{{ route('family.destroy', $family->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No families found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $families->appends(request()->query())->links('') }}
        </div>
    </div>
@endsection

@section('styles')
    <!-- Include Font Awesome for sort arrows if not already included -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection
