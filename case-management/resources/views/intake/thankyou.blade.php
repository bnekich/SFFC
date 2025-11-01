@extends('layouts.app')

@section('title')
    - Thank You
@endsection

@section('header')
    Submission Received
@endsection

@section('content')
    <p class="text-center text-lg">Thank you for your referral. Someone from our team will be in contact with you shortly.
    </p>
    <p class="text-center mt-4"><a href="{{ route('home') }}" class="sffc-link">Return to Home Page</a></p>
@endsection
