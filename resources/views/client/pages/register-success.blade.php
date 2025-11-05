@extends('layouts.client.client')
@section('title', 'Đăng ký thành công')
@section('breadcrumb', 'Đăng ký thành công')

@section('content')
<div class="ltn__login-area pb-110">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="section-title-area text-center">
                    <h1 class="section-title text-success">Đăng ký thành công 🎉</h1>
                    <p>Cảm ơn bạn đã đăng ký tài khoản! Chúng tôi đã gửi một email xác minh đến:</p>
                    <h4 class="text-primary mt-2">{{ $email }}</h4>
                    <p class="mt-3">Vui lòng kiểm tra hộp thư đến (hoặc thư mục Spam) để xác minh tài khoản trước khi đăng nhập.</p>
                </div>

                <div class="text-center mt-40">
                    <a href="{{ route('login') }}" class="theme-btn-1 btn reverse-color">Quay lại trang đăng nhập</a>
                    <a href="{{ url('/') }}" class="theme-btn-1 btn btn-effect-1">Về trang chủ</a>
                </div>

                <div class="text-center mt-4">
                    <form action="{{ route('register.resend') }}" method="POST">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">
                        <button type="submit" class="btn btn-link text-decoration-none">
                            Không nhận được email? <strong>Gửi lại email xác minh</strong>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
