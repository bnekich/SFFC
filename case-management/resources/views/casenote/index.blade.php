@extends('layouts.app')

@section('title')
    - Case Notes
@endsection

@section('content')
    <div class="container">
        <h3>Case Notes</h3>
        <div class="row mb-3">
            <div class="col-8">
                <form id="searchForm" method="GET" action="{{ route('casenote.index') }}">
                    <input id="searchBox" type="text" name="search" class="form-control-sm"
                        placeholder="Search case notes..." value="{{ request('search') }}">
                    <input type="hidden" name="case_id" value="{{ $case->id }}">
                    <button type="submit" class="btn btn-sm btn-primary">Search</button>
                    <button type="button" class="btn btn-sm btn-secondary" id="clearButton">Clear Search</button>
                </form>
            </div>
            <div class="col-auto align-items-end d-flex justify-content-end">
                @can('cases-create')
                    <a href="{{ route('casenote.create', ['case_id' => $case->id]) }}" class="btn btn-sm btn-primary">Add Case
                        Note</a>
                @endcan
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-sm table-hover mt-3">
                <thead>
                    <tr>
                        <th scope="col">Subject</th>
                        <th scope="col">Tags</th>
                        <th scope="col">Privacy Level</th>
                        <th scope="col">Status</th>
                        <th scope="col">Approved</th>
                        <th scope="col">Note</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($caseNotes as $caseNote)
                        <tr>
                            <td>{{ $caseNote->subject }}</td>
                            <td>{{ $caseNote->tags->pluck('name')->join(', ') }}</td>
                            <td>{{ $caseNote->privacy_level }}</td>
                            <td>{{ $caseNote->status }}</td>
                            <td>{{ $caseNote->is_approved ? 'Yes' : 'No' }}</td>
                            <td class="cm-table-description">{{ $caseNote->note }}</td>
                            <td>{{ $caseNote->created_at ? \Carbon\Carbon::parse($caseNote->created_at)->isoFormat('LL') : 'N/A' }}
                            </td>

                            <td>{{ $caseNote->updated_at ? \Carbon\Carbon::parse($caseNote->updated_at)->isoFormat('LL') : 'N/A' }}
                            </td>
                            <td class="text-nowrap">
                                <a href="{{ route('casenote.show', $caseNote->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <a href="{{ route('casenote.edit', $caseNote->id) }}"
                                    class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('casenote.destroy', $caseNote) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">
                            {{ $caseNotes->links() }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
{{-- @section('scripts')
    <script>
        document.getElementById('clearButton').addEventListener('click', function() {
            document.getElementById('searchBox').value = '';
            document.getElementById('searchForm').submit();
        });
    </script>
@endsection
@section('styles')
    <style>
        .table th,
        .table td {
            vertical-align: middle;
        }
    </style>
@endsection --}}
