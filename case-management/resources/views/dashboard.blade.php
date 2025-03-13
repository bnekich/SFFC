@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Dashboard
            @auth
                For {{ Auth::user()->firstName }} {{ Auth::user()->lastName }}
            @endauth
        </h1>
        <p>Welcome To Your Dashboard</p>
        @if (session('status'))
            <div style="color: green;">{{ session('status') }}</div>
        @endif <!-- Add your dashboard content here -->
    </div>
@endsection
