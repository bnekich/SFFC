@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Cases</h3>
        @can('cases-create')
            <a href="{{ route('cases.create') }}" class="btn btn-primary">Create New Case</a>
        @endcan
        <div class="table-responsive">
            <table class="table table-hover mt-3">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Case Identifier</th>
                        <th scope="col">Case Description</th>
                        <th scope="col" class="text-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cases as $case)
                        <tr>
                            <td>{{ $case->id }}</td>
                            <td>{{ $case->case_identifier }}</td>
                            <td class="cm-table-description">{{ $case->case_description }}</td>
                            <td class="d-flex flex-wrap gap-1 align-items-center">
                                @can('cases-view')
                                    <a href="{{ route('cases.show', $case->id) }}" class="btn btn-info btn-sm">View</a>
                                @endcan
                                @can('cases-update')
                                    <a href="{{ route('cases.edit', $case->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                @endcan
                                @can('cases-delete')
                                    <form class="d-inline" action="{{ route('cases.destroy', $case->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
