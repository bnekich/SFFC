@extends('layouts.app')
@section('title')
    - Training
@endsection

@section('content')
    <div class="container">
        <h3>Training</h3>
        <div class="col-md-6">
            <form method="GET" action="{{ route('course.index') }}">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search for Courses..."
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>

        @can('courses-create')
            <a href="{{ route('course.create') }}" class="btn btn-primary mb-3">Add organization</a>
        @endcan
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
                                <form action="{{ route('course.destroy', $courses) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $courses->withQueryString()->links() }}
    </div>
@endsection
