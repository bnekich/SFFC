@php
    use App\Enums\Statuses\IntakeStatus as Status;
@endphp

@extends('layouts.app')

@section('title')
    - Intake
@endsection

@section('content')
    <div class="container">
    @section('header')
        <h3>Intake</h3>
    @endsection

    <div class="row mb-3">
        <x-search route="intake.index" placeholder="Name or Summary" />
    </div>
    <div class="row mb-3">
        <div class="col-4">
            <form id="filterForm" method="GET" action="{{ route('intake.index') }}">
                <select name="status" class="form-control-sm" onchange="document.getElementById('filterForm').submit()">
                    <option value="">-- Filter by Status --</option>
                    @foreach ($statuses as $status)
                        <option value="{{ $status->value }}"
                            {{ request('status') == $status->value ? 'selected' : '' }}>
                            {{ $status->label() }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
        <div class="col-auto align-items-end d-flex justify-content-end">
            @can('intake-create')
                <a href="{{ route('intake.create') }}" class="btn btn-sm btn-primary">Add Intake</a>
            @endcan
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-sm table-hover mt-3">
            <thead>
                <tr>
                    <th scope="col">
                        <a
                            href="{{ route('intake.index', array_merge(request()->query(), ['sort' => 'parent_name', 'direction' => request('sort') === 'parent_name' && request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                            Parent Name
                            @if (request('sort') === 'parent_name')
                                <i class="fas fa-arrow-{{ request('direction') === 'asc' ? 'up' : 'down' }}"></i>
                            @endif
                        </a>
                    </th>
                    <th scope="col">Status</th>
                    <th scope="col">Case Summary</th>
                    <th scope="col" class="text-nowrap">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($intakes as $intake)
                    <tr>
                        <td>{{ $intake->parent_name }}</td>
                        <td>
                            @switch ($intake->intake_status)
                                @case(Status::InProgress->value)
                                    <span class="badge rounded-pill bg-success">{{ Status::InProgress->label() }}</span>
                                @break

                                @case(Status::FirstContactAttempt->value)
                                    <span
                                        class="badge rounded-pill bg-warning">{{ Status::FirstContactAttempt->label() }}</span>
                                @break

                                @case(Status::SecondContactAttempt->value)
                                    <span
                                        class="badge rounded-pill bg-warning">{{ Status::SecondContactAttempt->label() }}</span>
                                @break

                                @case(Status::ThirdContactAttempt->value)
                                    <span
                                        class="badge rounded-pill bg-warning">{{ Status::ThirdContactAttempt->label() }}</span>
                                @break

                                @case(Status::Other->value)
                                    <span class="badge rounded-pill bg-warning">{{ Status::Other->label() }}</span>
                                @break

                                @case(Status::Completed->value)
                                    <span class="badge rounded-pill bg-warning">{{ Status::Completed->label() }}</span>
                                @break

                                @case(Status::Closed->value)
                                    <span class="badge rounded-pill bg-danger">{{ Status::Closed->label() }}</span>
                                @break

                                @default
                                    <span class="badge rounded-pill bg-danger">{{ $intake->intake_status }}</span>
                            @endswitch
                        </td>
                        <td class="cm-table-description">{{ $intake->case_summary }}</td>
                        <td class="d-flex flex-wrap gap-1 align-items-center">
                            @can('intake-view')
                                <a href="{{ route('intake.show', $intake->id) }}" class="btn btn-info btn-sm">View</a>
                            @endcan
                            @can('intake-edit')
                                <a href="{{ route('intake.edit', $intake->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            @endcan
                            @can('intake-delete')
                                <form class="d-inline" action="{{ route('intake.destroy', $intake->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="4">No cases found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $intakes->appends(request()->query())->links('') }}
        </div>
    </div>
@endsection

@section('styles')
    <!-- Include Font Awesome for sort arrows if not already included -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection
