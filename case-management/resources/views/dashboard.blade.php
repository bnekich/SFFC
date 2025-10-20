@extends('layouts.app')

@section('title')
    - Dashboard
@endsection
@section('content')
@section('header')
    <h3>
        <p>{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}, Welcome To Your Dashboard</p>
    </h3>
@endsection
<div class="row">
    @foreach (auth()->user()->dashboard_preferences ?? ['open_cases', 'pending_appointments', 'volunteers'] as $item)
        @if ($item === 'open_cases')
            <div class="col-md-4">
                <x-dashboard-item-open-cases />
                {{-- :user_id={{ auth()->user()->id }} /> --}}
            </div>
        @endif
        @if ($item === 'pending_appointments')
            <div class="col-md-4">
                <x-dashboard-item-pending-appointments />
            </div>
        @endif
        @if ($item === 'new_volunteers')
            <div class="col-md-4">
                <x-dashboard-item-volunteers />
            </div>
        @endif
    @endforeach
</div>
@endsection
