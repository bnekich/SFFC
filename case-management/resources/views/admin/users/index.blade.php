@extends('layouts.app')

@section('title')
    - Users
@endsection

@section('content')
@section('header')
    Users
@endsection
<div class="flex justify-between items-center mb-4">
    <x-search :route="route('users.index')" placeholder="Name or Email" />
</div>

@can('user-create')
    <a href="{{ route('users.create') }}" class="sffc-btn-primary mb-4">Add User</a>
@endcan

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="sffc-table">
            <thead class="sffc-table-header">
                <tr>
                    <th class="sffc-table-header-cell" scope="col"><a
                            href="{{ route('users.index', array_merge(request()->query(), ['sort' => 'lastName', 'direction' => request('sort') === 'lastName' && request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                            Name
                            @if (request('sort') === 'lastName')
                                <i class="fas fa-arrow-{{ request('direction') === 'asc' ? 'up' : 'down' }}"></i>
                            @endif
                        </a></th>
                    <th class="sffc-table-header-cell" scope="col">Email</th>
                    <th class="sffc-table-header-cell" scope="col">Role(s)</th>
                    @canany(['user-create', 'user-edit', 'user-delete'])
                        <th scope="col" class="sffc-table-header-cell">Actions</th>
                    @endcanany
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="sffc-table-body-cell-primary">{{ $user->firstName . ' ' . $user->lastName }}</td>
                        <td class="sffc-table-body-cell">{{ $user->email }}</td>
                        <td class="sffc-table-body-cell text-ellipsis">{{ $user->roles->pluck('name')->join(', ') }}

                        <td class="sffc-table-body-cell ">
                            @canany(['user-create', 'user-edit', 'user-delete'])
                                <a href="{{ route('users.edit', $user) }}"
                                    class="text-yellow-600 hover:text-yellow-900">Edit</a>
                            @endcanany
                            @can('user-delete')
                                <x-delete-confirmation :route="route('users.destroy', $user)" :item-id="$user->id"
                                    message="Are you sure you want to delete this user?" />
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{ $users->withQueryString()->links() }}


@if (session('temp_password'))
    <p>Temporary Password: {{ session('temp_password') }} (Share this securely with the user)</p>
@endif
@endsection
