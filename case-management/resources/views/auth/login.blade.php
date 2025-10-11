@extends('layouts.app')

@section('title')
    - Login
@endsection

@section('content')
@section('header')
    <div class="place-items-center text-center">
        <img src="images/sffc_logo.jpg" alt="Safe Families for Children Logo" class="w-1/2 max-w-md mb-8 rounded-lg shadow-md">
        <span class="text-kg">Please enter your Email Address and Password</span>
    </div>
@endsection

<form class="space-y-4 m-2" method="POST" action="{{ route('login') }}">
    @csrf
    <div class="flex flex-direction-row gap-6">
        <div class="flex flex-row gap-6">
            <label for="email" class="sffc-label">{{ __('Email Address') }}<span
                    class="text-red-500">*</span></label>
            <input id="email" type="email" name="email"
                class="sffc-text-input @error('email') border-red-500 @enderror" value="{{ old('email') }}" required>
            @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex flex-row gap-6">
            <label for="password" class="sffc-label">{{ __('Password') }}<span class="text-red-500">*</span></label>
            <input id="password" type="password" class="sffc-text-input @error('password') border-red-500 @enderror"
                name="password" required autocomplete="current-password">
            @error('password')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex flex-row gap-6 justify-center">
            <button type="submit" class="sffc-btn-primary">{{ __('Login') }}</button>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                    class="inline-flex justify-center py-2 px-4 text-sm font-medium text-gray-700">
                    {{ __('Forgot Your Password?') }}</a>
            @endif
        </div>
    </div>
</form>
@endsection
