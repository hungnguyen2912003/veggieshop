@extends('layouts.client.client')

@section('title', 'Forgot Password')
@section('breadcrumb', 'Forgot Password')

@section('content')
<div class="ltn__login-area pb-110">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area text-center">
                    <h1 class="section-title">Forgot Your Password?</h1>
                    <p>No worries! Enter your registered email and we’ll send you a link to reset your password.</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="account-login-inner">
                    {{-- Forgot Password Form --}}
                    <form action="{{ route('password.email') }}" method="POST" class="ltn__form-box contact-form-box">
                        @csrf
                        
                        <input type="email" name="email" placeholder="Enter your email address" value="{{ old('email') }}" required>
                        @error('email')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror

                        <div class="btn-wrapper mt-3 text-center">
                            <button class="theme-btn-1 btn reverse-color btn-block" type="submit">
                                Send Reset Link
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
