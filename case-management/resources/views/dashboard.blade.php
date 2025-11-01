@extends('layouts.app')

@section('title')
    - Dashboard
@endsection

@section('content')

@section('header')
    {{ Auth::user()->firstName }} {{ Auth::user()->lastName }}, Welcome To Your Dashboard
@endsection

@forelse (auth()->user()->dashboard_preferences ?? [] as $item)
    @if ($item === 'open_cases')
        <x-dashboard-item-open-cases />
        {{-- :user_id={{ auth()->user()->id }} /> --}}
    @endif
    @if ($item === 'pending_appointments')
        <x-dashboard-item-pending-appointments />
    @endif
    @if ($item === 'new_volunteers')
        <x-dashboard-item-volunteers />
    @endif
@empty
    No Dashboard Items Set
@endforelse

@endsection
