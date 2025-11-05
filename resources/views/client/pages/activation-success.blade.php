@extends('layouts.client.client')
@section('title', 'Kích hoạt tài khoản thành công')
@section('breadcrumb', 'Kích hoạt tài khoản')

@section('content')
<div class="ltn__login-area pb-110">
    <div class="container text-center">
        <h1 class="section-title text-success mt-5">Tài khoản của bạn đã được kích hoạt!</h1>
        <p class="mt-3">Chào mừng, <strong>{{ $user->name }}</strong> 🎉</p>
        <p>Bạn có thể đăng nhập và bắt đầu sử dụng tài khoản của mình ngay bây giờ.</p>
        <a href="{{ route('login') }}" class="theme-btn-1 btn reverse-color mt-3">Đến trang đăng nhập</a>
    </div>
</div>
@endsection
