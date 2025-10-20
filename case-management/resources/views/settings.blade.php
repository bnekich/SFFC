@extends('layouts.app')

@section('content')
@section('header')
    <h3>{{ 'Dashboard Settings' }}</h3>
@endsection
<form method="POST" action="{{ route('dashboard.settings') }}">
    @csrf
    <div class="">
        <label>Select Dashboard Items:</label><br>
        <div class="">
            <input type="checkbox" name="dashboard_items[]" value="open_cases"
                {{ in_array('open_cases', auth()->user()->dashboard_preferences ?? []) ? 'checked' : '' }}>
            <label>Open Cases</label>
        </div>
        <div class="">
            <input type="checkbox" name="dashboard_items[]" value="pending_appointments"
                {{ in_array('pending_appointments', auth()->user()->dashboard_preferences ?? []) ? 'checked' : '' }}>
            <label>Pending Appointments</label>
        </div>
        <div class="">
            <input type="checkbox" name="dashboard_items[]" value="new_volunteers"
                {{ in_array('new_volunteers', auth()->user()->dashboard_preferences ?? []) ? 'checked' : '' }}>
            <label>New Volunteers</label>
        </div>

    </div>
    {{-- <div x-data="{ switchOn: false }" class="flex items-center justify-center space-x-2">
        <input id="open_cases" type="checkbox" name="dashboard_items[]" class="hidden" :checked="switchOn">

        <button x-ref="switchButton" type="button" @click="switchOn = ! switchOn"
            :class="switchOn ? 'bg-blue-600' : 'bg-neutral-200'"
            class="relative inline-flex h-6 py-0.5 ml-4 focus:outline-none rounded-full w-10" x-cloak>
            <span :class="switchOn ? 'translate-x-[18px]' : 'translate-x-0.5'"
                class="w-5 h-5 duration-200 ease-in-out bg-white rounded-full shadow-md"></span>
        </button>

        <label @click="$refs.switchButton.click(); $refs.switchButton.focus()" :id="$id('switch')"
            :class="{ 'text-blue-600': switchOn, 'text-gray-400': !switchOn }" class="text-sm select-none" x-cloak>
            Open Cases
        </label>
    </div> --}}
    <button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection
