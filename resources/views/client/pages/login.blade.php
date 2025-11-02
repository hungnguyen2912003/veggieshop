@extends('layouts.client.client')

@section('title', 'Login')
@section('breadcrumb', 'Login')

@section('content')
<div class="ltn__login-area pb-110">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area text-center">
                    <h1 class="section-title">Sign In to Your Account</h1>
                    <p>Welcome back! Please enter your credentials to access your account.</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="account-login-inner">
                    {{-- Login Form --}}
                    <form action="{{ route('login.post') }}" method="POST" class="ltn__form-box contact-form-box">
                        @csrf

                        {{-- Email --}}
                        <input type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" autofocus>
                        @error('email')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror

                        {{-- Password --}}
                        <input type="password" name="password" placeholder="Enter your password">
                        @error('password')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror

                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <label class="mb-0">
                                <input type="checkbox" name="remember"> Remember Me
                            </label>
                            <a href="#" class="text-decoration-none">
                                Forgot Password?
                            </a>
                        </div>

                        <div class="btn-wrapper mt-3">
                            <button class="theme-btn-1 btn reverse-color btn-block" type="submit">Sign In</button>
                        </div>
                    </form>

                    {{-- Divider --}}
                    <div class="text-center mt-4">
                        <span>Don't have an account?</span>
                        <a href="{{ route('register.form') }}" class="text-decoration-none">
                            <strong>Create one here</strong>
                        </a>
                    </div>

                    {{-- Optional: Social login section --}}
                    {{-- <div class="text-center mt-4">
                        <p class="mb-2">Or sign in with</p>
                        <a href="#" class="btn btn-outline-secondary btn-sm mx-1">Google</a>
                        <a href="#" class="btn btn-outline-secondary btn-sm mx-1">Facebook</a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
