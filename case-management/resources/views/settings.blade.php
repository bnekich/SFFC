@extends('layouts.app')

@section('content')
    <div class="container">
    @section('header')
        <h3>{{ 'Dashboard Settings' }}</h3>
    @endsection
    <form method="POST" action="{{ route('dashboard.settings') }}">
        @csrf
        <div class="mb-3">
            <label>Select Dashboard Items:</label><br>
            <div class="form-check">
                <input type="checkbox" name="dashboard_items[]" value="open_cases"
                    {{ in_array('open_cases', auth()->user()->dashboard_preferences ?? []) ? 'checked' : '' }}>
                <label>Open Cases</label>
            </div>
            <div class="form-check">
                <input type="checkbox" name="dashboard_items[]" value="pending_appointments"
                    {{ in_array('pending_appointments', auth()->user()->dashboard_preferences ?? []) ? 'checked' : '' }}>
                <label>Pending Appointments</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
