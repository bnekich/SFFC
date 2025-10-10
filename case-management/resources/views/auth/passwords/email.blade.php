@extends('layouts.app')

@section('title')
    - Reset Password
@endsection

@section('content')
@section('header')
    <div class="place-items-center text-center">
        <img src="/images/sffc_logo.jpg" alt="Safe Families for Children Logo" class="max-w-md mb-8 rounded-lg shadow-md ">
        <p class="uppercase">Please enter your email address. You will receive an email with a link to reset your password.
        </p>
    </div>
@endsection

<form class="p-4 space-y-6" method="POST" action="{{ route('password.email') }}">
    @csrf
    <div>
        <label for="email" class="sffc-label">{{ __('Email Address') }}<span class="text-red-500">*</span></label>
        <input id="email" type="email" name="email" placeholder="Email"
            class="sffc-text-input @error('email') border-red-500 @enderror" value="{{ old('email') }}" required>
        @error('email')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="sffc-btn-primary">
                {{ __('Send Password Reset Link') }}
            </button>
        </div>
    </div>
</form>
@endsection
