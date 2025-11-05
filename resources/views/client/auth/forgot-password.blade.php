@extends('layouts.client.client')

@section('title', 'Quên mật khẩu')
@section('breadcrumb', 'Quên mật khẩu')

@section('content')
<div class="ltn__login-area pb-110">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area text-center">
                    <h1 class="section-title">Quên mật khẩu?</h1>
                    <p>Đừng lo! Hãy nhập địa chỉ email bạn đã đăng ký, chúng tôi sẽ gửi cho bạn một liên kết để đặt lại mật khẩu.</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="account-login-inner">
                    {{-- Form Quên mật khẩu --}}
                    <form action="{{ route('password.email') }}" method="POST" class="ltn__form-box contact-form-box">
                        @csrf
                        
                        <input type="email" name="email" placeholder="Nhập địa chỉ email của bạn" value="{{ old('email') }}" required>
                        @error('email')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror

                        <div class="btn-wrapper mt-3 text-center">
                            <button class="theme-btn-1 btn reverse-color btn-block" type="submit">
                                Gửi liên kết đặt lại mật khẩu
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
