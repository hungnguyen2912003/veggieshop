@extends('layouts.client.client')

@section('title', 'Đăng nhập')
@section('breadcrumb', 'Đăng nhập')

@section('content')
<div class="ltn__login-area pb-110">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area text-center">
                    <h1 class="section-title">Đăng nhập tài khoản của bạn</h1>
                    <p>Chào mừng bạn quay lại! Vui lòng nhập thông tin để truy cập vào tài khoản của bạn.</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="account-login-inner">
                    {{-- Form đăng nhập --}}
                    <form action="{{ route('login.post') }}" method="POST" class="ltn__form-box contact-form-box">
                        @csrf

                        {{-- Email --}}
                        <input type="email" name="email" placeholder="Nhập địa chỉ email" value="{{ old('email') }}" autofocus>
                        @error('email')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror

                        {{-- Mật khẩu --}}
                        <input type="password" name="password" placeholder="Nhập mật khẩu">
                        @error('password')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror

                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <label class="mb-0">
                                <input type="checkbox" name="remember"> Ghi nhớ đăng nhập
                            </label>
                            <a href="{{ route('password.request') }}" class="text-decoration-none">
                                Quên mật khẩu?
                            </a>
                        </div>

                        <div class="btn-wrapper mt-3 text-center">
                            <button class="theme-btn-1 btn reverse-color btn-block" type="submit">Đăng nhập</button>
                        </div>
                    </form>

                    {{-- Phân cách --}}
                    <div class="text-center mt-4">
                        <span>Chưa có tài khoản?</span>
                        <a href="{{ route('register.form') }}" class="text-decoration-none">
                            <strong>Đăng ký ngay</strong>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
