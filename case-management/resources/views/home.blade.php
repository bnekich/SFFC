@extends('layouts.app')
@section('title', 'Home')

@section('content')
    <section>
        <h1 class="custom-color">Welcome to My App</h1>
        <p>Please <a href="{{ route('login') }}" class="custom-color">log in</a> to continue.</p>
    </section>
@endsection
