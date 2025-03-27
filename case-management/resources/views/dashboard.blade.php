@extends('layouts.app')

@section('title')
    - Dashboard
@endsection
@section('content')
    <div class="container">
        <h3>
            <p>{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}, Welcome To Your Dashboard</p>
        </h3>
        <div class="row">
            @foreach (auth()->user()->dashboard_preferences ?? ['open_cases', 'pending_appointments'] as $item)
                @if ($item === 'open_cases')
                    <div class="col-md-4">
                        <x-dashboard-item-open-cases />
                    </div>
                @elseif($item === 'pending_appointments')
                    <div class="col-md-4">
                        <x-dashboard-item-pending-appointments />
                    </div>
                @endif
            @endforeach
        </div>
        <a href="{{ route('dashboard.settings') }}" class="btn btn-primary mt-3">Customize Dashboard</a>
    </div>
@endsection
