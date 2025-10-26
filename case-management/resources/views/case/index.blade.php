@extends('layouts.app')

@section('title')
    - Cases
@endsection

@section('content')
@section('header')
    Cases
@endsection
<div class="flex justify-between items-center mb-4">
    <x-search :route="route('case.index', ['direction' => 'asc', 'sort' => 'case_identifier'])" placeholder="Identifier or Description" />

    <form class="mb-4" id="filterForm" method="GET" action="{{ route('case.index') }}">
        <div>
            <select name="status" onchange="document.getElementById('filterForm').submit()">
                <option value="">-- Filter by Status --</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status->id }}" {{ request('status') == $status->id ? 'selected' : '' }}>
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <input type="hidden" id="user_id" name="user_id" value="{{ $user_id }}">
            {{-- TODO implement for users who generally come to this page and see all cases --}}
            {{-- <div x-data="{ value: true }" x-id="['toggle-label']">
            <label @click="$refs.toggle.click(); $refs.toggle.focus()" :id="['toggle-label']"
                class="text-black transition-colors dark:text-white">Show My Cases</label>
            <button x-ref="toggle" @click="document.getElementById('filterForm').submit()" type="button" role="switch"
                :aria-checked="value"
                :class="value ? 'bg-black border-2 border-white' : 'bg-white border-2 border-black'"
                class="ml-4 relative w-14 py-1 px-0 inline-flex rounded-full focus:outline-none focus:ring-aqua-400">
                <span :class="value ? 'bg-white translate-x-6' : 'bg-black translate-x-1'"
                    class="w-6 h-6 rounded-full transition" aria-hidden="true"></span>
            </button>
        </div> --}}
        </div>
    </form>
    @can('case-create')
        <a href="{{ route('case.create') }}" class="mb-4 inline-flex sffc-btn-primary">Add Case</a>
    @endcan
</div>

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="sffc-table">
            <thead class="sffc-table-header">
                <tr>
                    <th scope="col" class="sffc-table-header-cell">
                        <a
                            href="{{ route('case.index', array_merge(request()->query(), ['sort' => 'case_identifier', 'direction' => request('sort') === 'case_identifier' && request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                            Case Identifier
                            @if (request('sort') === 'case_identifier')
                                <i
                                    class="fas fa-arrow-{{ request('direction') === 'asc' || request('direction') === null ? 'up' : 'down' }}"></i>
                            @endif
                        </a>
                    </th>
                    <th scope="col" class="sffc-table-header-cell">Status</th>
                    <th scope="col" class="sffc-table-header-cell">Case Description</th>
                    <th scope="col" class="sffc-table-header-cell">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cases as $case)
                    <tr class="hover:bg-gray-50">
                        <td class="sffc-table-body-cell-primary">{{ $case->case_identifier }}</td>
                        <td class="sffc-table-body-cell">
                            {{ $case->caseStatus->name }}
                        </td>
                        <td class="sffc-table-body-cell-clipped">
                            {{ $case->case_description }}</td>
                        <td class="sffc-table-body-cell-actions">
                            <a href="{{ route('note.create', ['case_id' => $case->id]) }}"
                                class="text-indigo-600 hover:text-indigo-900">Add Note</a>
                            @can('case-view')
                                <a href="{{ route('case.show', $case->id) }}" class="sffc-link-view">View</a>
                            @endcan
                            @can('case-edit')
                                <a href="{{ route('case.edit', $case->id) }}" class="sffc-link-edit">Edit</a>
                            @endcan
                            @can('case-delete')
                                <x-delete-confirmation :route="route('case.destroy', $case)" :item-id="$case->id"
                                    message="Are you sure you want to delete this case?" />
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
    </div>
</div>
{{ $cases->withQueryString()->links() }}
@endsection
