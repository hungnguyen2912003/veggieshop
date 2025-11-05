@extends('layouts.client.client')

@section('title', 'Đặt lại mật khẩu')
@section('breadcrumb', 'Đặt lại mật khẩu')

@section('content')
<div class="ltn__login-area pb-110">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area text-center">
                    <h1 class="section-title">Đặt lại mật khẩu của bạn</h1>
                    <p>Nhập mật khẩu mới bên dưới để hoàn tất việc đặt lại tài khoản của bạn.</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="account-login-inner">
                    {{-- Form Đặt lại mật khẩu --}}
                    <form action="{{ route('password.update') }}" method="POST" class="ltn__form-box contact-form-box">
                        @csrf

                        {{-- Token ẩn (gửi qua email) --}}
                        <input type="hidden" name="token" value="{{ $token }}">

                        {{-- Email (chỉ đọc) --}}
                        <input type="email" name="email" value="{{ request('email') }}" readonly>

                        {{-- Mật khẩu mới --}}
                        <input type="password" name="password" placeholder="Mật khẩu mới" required>
                        @error('password')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror

                        {{-- Xác nhận mật khẩu --}}
                        <input type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu mới" required>

                        {{-- Nút gửi --}}
                        <div class="btn-wrapper mt-3 text-center">
                            <button class="theme-btn-1 btn reverse-color" type="submit">
                                Đặt lại mật khẩu
                            </button>
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ route('login') }}" class="text-decoration-none">
                                Quay lại trang đăng nhập
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
