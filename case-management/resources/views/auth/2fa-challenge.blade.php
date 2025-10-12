@extends('layouts.app')

@section('content')
@section('header')
    <div class="place-items-center text-center">
        <img src="/images/sffc_logo.jpg" alt="Safe Families for Children Logo" class="max-w-md mb-8 rounded-lg shadow-md ">
        <p class="uppercase">Get A Verification Code To Complete The Login Process</p>
    </div>
@endsection

@if (!$codeSent)
    <div class="place-items-center text-center">
        <p class="text-lg text-blue-700 font-medium">Please select a method to receive your verification code.</p>
        <form method="POST" action="{{ route('2fa.send') }}">
            @csrf
            <input type="hidden" name="method" value="email">
            <button type="submit" class="sffc-btn-primary m-2" {{ !$hasEmail ? 'disabled' : '' }}>
                Send Code via Email
            </button>
        </form>

        <form method="POST" action="{{ route('2fa.send') }}">
            @csrf
            <input type="hidden" name="method" value="sms">
            <button type="submit" class="sffc-btn-primary" {{ !$hasSms ? 'disabled' : '' }}>
                Send Code via Text Message
            </button>
        </form>
        @if (!$hasSms)
            <small class="d-block mt-2 text-muted">Text Message option is disabled because no phone
                number is on
                file for your account.</small>
        @endif
    </div>
@else
    <div class="place-items-center text-center">
        <form method="POST" action="{{ route('2fa.verify') }}" class="p-4 space-y-6">
            @csrf

            <label for="code" class="sffc-label">{{ __('Enter Verification Code') }}</label>

            <input id="code" type="text" class="sffc-text-input @error('code') border-red-500 @enderror"
                name="code" required autocomplete="one-time-code" autofocus>

            @error('code')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror

            <button type="submit" class="sffc-btn-primary">
                {{ __('Verify') }}
            </button>
        </form>
        <a class="sffc-label" href="{{ route('2fa.challenge') }}">Didn't receive a code? Send again.</a>
    </div>
@endif
@endsection
