@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>
            <p>{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}, Welcome To Your Dashboard</p>
        </h3>

        @if (session('status'))
            <div style="color: green;">{{ session('status') }}</div>
        @endif <!-- Add your dashboard content here -->
    </div>
@endsection
