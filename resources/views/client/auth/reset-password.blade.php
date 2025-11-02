@extends('layouts.client.client')

@section('title', 'Reset Password')
@section('breadcrumb', 'Reset Password')

@section('content')
<div class="ltn__login-area pb-110">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area text-center">
                    <h1 class="section-title">Reset Your Password</h1>
                    <p>Enter your new password below to complete resetting your account.</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="account-login-inner">
                    {{-- Reset Password Form --}}
                    <form action="{{ route('password.update') }}" method="POST" class="ltn__form-box contact-form-box">
                        @csrf

                        {{-- Hidden token (sent via email link) --}}
                        <input type="hidden" name="token" value="{{ $token }}">

                        {{-- Email (readonly) --}}

                        <input type="email" name="email" value="{{ request('email') }}" readonly>

                        {{-- New Password --}}
                        <input type="password" name="password" placeholder="New Password" required>
                        @error('password')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror

                        {{-- Confirm Password --}}
                        <input type="password" name="password_confirmation" placeholder="Confirm New Password" required>

                        {{-- Submit --}}
                        <div class="btn-wrapper mt-3 text-center">
                            <button class="theme-btn-1 btn reverse-color" type="submit">
                                Reset Password
                            </button>
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ route('login') }}" class="text-decoration-none">
                                Back to Login
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
