@extends('layouts.app')

@section('title')
    - Home
@endsection

@section('content')
@section('header')
    <div class="place-items-center text-center">
        <img src="images/sffc_logo.jpg" alt="Safe Families for Children Logo" class="w-1/2 max-w-md mb-8 rounded-lg shadow-md">
        <span class="text-3xl font-bold text-white-800 mb-4">Welcome to the Safe Families for Children Case Management System
        </span>
    </div>
@endsection

<div class="place-items-center text-center">
    <p class="font-bold text-2xl bold mb-4 uppercase">keeping children safe and families together</p>
    <p class="font-bold">Please <a href="login"
            class="text-blue-600 hover:text-blue-800 font-medium underline transition-colors">log in</a> to
        continue.</p>
</div>

@endsection
