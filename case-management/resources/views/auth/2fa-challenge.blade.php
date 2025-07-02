@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Two-Factor Authentication') }}</div>

                    <div class="card-body">
                        <p>Please complete the second step of authentication.</p>

                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if (!$codeSent)
                            <p>Please select a method to receive your verification code.</p>
                            <form method="POST" action="{{ route('2fa.send') }}" class="d-inline">
                                @csrf
                                <input type="hidden" name="method" value="email">
                                <button type="submit" class="btn btn-primary" {{ !$hasEmail ? 'disabled' : '' }}>
                                    Send Code via Email
                                </button>
                            </form>

                            <form method="POST" action="{{ route('2fa.send') }}" class="d-inline">
                                @csrf
                                <input type="hidden" name="method" value="sms">
                                <button type="submit" class="btn btn-secondary" {{ !$hasSms ? 'disabled' : '' }}>
                                    Send Code via SMS
                                </button>
                            </form>
                            @if (!$hasSms)
                                <small class="d-block mt-2 text-muted">SMS option is disabled because no phone number is on
                                    file for your account.</small>
                            @endif
                        @else
                            <p>A verification code has been sent. Please enter it below.</p>
                            <form method="POST" action="{{ route('2fa.verify') }}">
                                @csrf

                                <div class="row mb-3">
                                    <label for="code"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Verification Code') }}</label>

                                    <div class="col-md-6">
                                        <input id="code" type="text"
                                            class="form-control @error('code') is-invalid @enderror" name="code" required
                                            autocomplete="one-time-code" autofocus>

                                        @error('code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Verify') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a href="{{ route('2fa.challenge') }}">Didn't receive a code? Send again.</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
