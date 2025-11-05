@extends('layouts.client.client')
@section('title', 'Đăng ký tài khoản')
@section('breadcrumb', 'Đăng ký')

@section('content')
<div class="ltn__login-area pb-110">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area text-center">
                    <h1 class="section-title">Tạo tài khoản của bạn</h1>
                    <p>Đăng ký để quản lý hồ sơ, theo dõi đơn hàng và tận hưởng các dịch vụ cá nhân hóa.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="account-login-inner">
                    <form action="{{ route('register.post') }}" method="POST" class="ltn__form-box contact-form-box">
                        @csrf
                        
                        {{-- Họ và tên --}}
                        <input type="text" name="name" placeholder="Họ và tên">
                        @error('name')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror

                        {{-- Email --}}
                        <input type="email" name="email" placeholder="Địa chỉ Email">
                        @error('email')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror

                        {{-- Mật khẩu --}}
                        <input type="password" name="password" placeholder="Mật khẩu">
                        @error('password')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror

                        {{-- Xác nhận mật khẩu --}}
                        <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu">

                        <div class="btn-wrapper mt-3 text-center">
                            <button class="theme-btn-1 btn reverse-color btn-block" type="submit">Tạo tài khoản</button>
                        </div>
                    </form>

                    <div class="by-agree text-center mt-4">
                        <p>Khi tạo tài khoản, bạn đồng ý với 
                            <a href="#">Điều khoản dịch vụ</a> và 
                            <a href="#">Chính sách bảo mật</a> của chúng tôi.
                        </p>
                        <div class="go-to-btn mt-30">
                            <a href="{{ route('login') }}">Đã có tài khoản? <strong>Đăng nhập ngay</strong></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
