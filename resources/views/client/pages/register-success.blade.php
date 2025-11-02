@extends('layouts.client.client')
@section('title', 'Registration Successful')
@section('breadcrumb', 'Registration Successful')

@section('content')
<div class="ltn__login-area pb-110">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="section-title-area text-center">
                    <h1 class="section-title text-success">Registration Successful 🎉</h1>
                    <p>Thank you for signing up! We’ve sent a verification email to:</p>
                    <h4 class="text-primary mt-2">{{ $email }}</h4>
                    <p class="mt-3">Please check your inbox (and spam folder) to verify your account before logging in.</p>
                </div>

                <div class="text-center mt-40">
                    <a href="{{ route('login') }}" class="theme-btn-1 btn reverse-color">Back to Login</a>
                    <a href="{{ url('/') }}" class="theme-btn-1 btn btn-effect-1">Go to Homepage</a>
                </div>

                <div class="text-center mt-4">
                    <form action="{{ route('register.resend') }}" method="POST">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">
                        <button type="submit" class="btn btn-link text-decoration-none">
                            Didn’t receive the email? <strong>Resend Verification</strong>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
