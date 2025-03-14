@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Cases</h1>
        <a href="{{ route('cases.create') }}" class="btn btn-primary">Create New Case</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Case Identifier</th>
                    <th>Case Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cases as $case)
                    <tr>
                        <td>{{ $case->id }}</td>
                        <td>{{ $case->case_identifier }}</td>
                        <td>{{ $case->case_description }}</td>
                        <td>
                            <a href="{{ route('cases.show', $case->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('cases.edit', $case->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('cases.destroy', $case->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
