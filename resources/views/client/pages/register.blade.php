@extends('layouts.client.client')
@section('title', 'Register')
@section('breadcrumb', 'Register')

@section('content')
<div class="ltn__login-area pb-110">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area text-center">
                    <h1 class="section-title">Create Your Account</h1>
                    <p>Sign up to manage your profile, track your orders, and enjoy personalized services.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="account-login-inner">
                    <form action="{{ route('register.post') }}" method="POST" class="ltn__form-box contact-form-box">
                        @csrf
                        
                        {{-- Name --}}
                        <input type="text" name="name" placeholder="Full Name">
                        @error('name')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror

                        {{-- Email --}}
                        <input type="email" name="email" placeholder="Email Address">
                        @error('email')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror

                        {{-- Password --}}
                        <input type="password" name="password" placeholder="Password">
                        @error('password')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror

                        {{-- Confirm Password --}}
                        <input type="password" name="password_confirmation" placeholder="Confirm Password">

                        <div class="btn-wrapper mt-3">
                            <button class="theme-btn-1 btn reverse-color btn-block" type="submit">Create Account</button>
                        </div>
                    </form>

                    <div class="by-agree text-center mt-4">
                        <p>By creating an account, you agree to our 
                            <a href="#">Terms of Service</a> and 
                            <a href="#">Privacy Policy</a>.
                        </p>
                        <div class="go-to-btn mt-30">
                            <a href="{{ route('login') }}">Already have an account? Login here.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
