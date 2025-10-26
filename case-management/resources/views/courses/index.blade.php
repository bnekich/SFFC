@extends('layouts.app')
@section('title')
    - Training
@endsection

@section('content')
    <div class="container">
    @section('header')
        Training Courses
    @endsection
    <div class="row mb-3">"
        <x-search :route="route('course.index')" placeholder="Title or Instructor" />
        {{-- <div class="col-8">
                <form id="searchForm" method="GET" action="{{ route('course.index') }}">
                    <input id="searchBox" type="text" name="search" class="form-control-sm"
                        placeholder="Search for Courses..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-sm btn-primary">Search</button>
                    <button type="button" class="btn btn-sm btn-secondary" id="clearButton">Clear Search</button>
                </form>
            </div> --}}
        <div class="col-auto align-items-end d-flex justify-content-end">
            @can('courses-create')
                <a href="{{ route('course.create') }}" class="btn btn-sm btn-primary mb-3">Add Course</a>
            @endcan
        </div>
    </div>
    <table class="table table-sm table-hover ">
        <thead>
            <tr>
                <th>Title</th>
                <th>Instructor</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $course)
                <tr>
                    <td>{{ $course->title }} </td>
                    <td>{{ $course->instructor->first_name . ' ' . $course->instructor->last_name }}</td>
                    <td>
                        <a href="{{ route('course.show', $course) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('course.edit', $course) }}" class="btn btn-warning btn-sm">Edit</a>
                        @can('courses-delete')
                            <x-delete-confirmation :route="route('courses.destroy', $course)" :item-id="$course->id"
                                message="Are you sure you want to delete this course?" />
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $courses->withQueryString()->links() }}
</div>
@endsection
