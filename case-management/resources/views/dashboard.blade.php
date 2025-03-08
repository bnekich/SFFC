@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Dashboard
            @auth
                For {{ Auth::user()->name }}
            @endauth
        </h1>
        <p>Welcome To Your Dashboard</p>
        <!-- Add your dashboard content here -->
    </div>
@endsection
