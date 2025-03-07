@extends('layouts.app')
@section('title', 'Home')

@section('content')
    <section class="bg-green-200">
        <h1>Welcome to My App</h1>
        <p>Please <a href="{{ route('login') }}">log in</a> to continue.</p>
    </section>
@endsection
