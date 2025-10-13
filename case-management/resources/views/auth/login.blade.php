@extends('layouts.app')

@section('title')
    - Login
@endsection

@section('content')

@section('header')
    <div class="place-items-center text-center">
        <img src="images/sffc_logo.jpg" alt="Safe Families for Children Logo" class="w-1/2 max-w-md mb-2 rounded-lg shadow-md">
        <blockquote class="italic p-4"> Therefore if you have any encouragement from being united with
            Christ, if any comfort
            from his
            love, if any common sharing in the Spirit, if any tenderness and compassion, then make my joy complete by being
            like-minded, having the same love, being one in spirit and of one mind. Do nothing out of selfish ambition or
            vain conceit. Rather, in humility value others above yourselves, not looking to your own interests but each of
            you to the interests of the others. (Phil 2:1-5 NASB)</blockquote>
    </div>
@endsection
<div class="place-items-center">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label for="email" class="sffc-label">{{ __('Email Address') }}<span class=" text-red-500">*</span></label>
        <input id="email" type="email" name="email"
            class="sffc-text-input @error('email') border-red-500 @enderror" value="{{ old('email') }}" required
            placeholder="Email">
        @error('email')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
        <label for="password" class="">{{ __('Password') }}<span class="text-red-500">*</span></label>
        <input id="password" type="password" class="sffc-text-input @error('password') border-red-500 @enderror"
            name="password" required autocomplete="current-password" placeholder="Password">
        @error('password')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
        <button type="submit" class="sffc-btn-primary mt-2">{{ __('Login') }}</button>
        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="text-sm font-medium text-gray-700">
                {{ __('Forgot Your Password?') }}</a>
        @endif
    </form>
</div>
@endsection
