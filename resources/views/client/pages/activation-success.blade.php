@extends('layouts.client.client')
@section('title', 'Account Activated')
@section('breadcrumb', 'Account Activated')

@section('content')
<div class="ltn__login-area pb-110">
    <div class="container text-center">
        <h1 class="section-title text-success mt-5">Your Account Has Been Activated!</h1>
        <p class="mt-3">Welcome, <strong>{{ $user->name }}</strong> 🎉</p>
        <p>You can now log in and start using your account.</p>
        <a href="{{ route('login') }}" class="theme-btn-1 btn reverse-color mt-3">Go to Login</a>
    </div>
</div>
@endsection
