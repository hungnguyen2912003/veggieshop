@extends('layouts.client.client')

@section('title', 'Không tìm thấy trang')

@section('breadcrumb', 'Không tìm thấy trang')

@section('content')
<div class="ltn__404-area ltn__404-area-1 mb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="error-404-inner text-center">
                    <h1 class="error-404-title">404</h1>
                    <h2>Trang không tồn tại!</h2>
                    <p>Rất tiếc! Trang bạn đang tìm kiếm không tồn tại, có thể đã bị xóa hoặc di chuyển sang vị trí khác.</p>
                    <div class="btn-wrapper">
                        <a href="/" class="btn btn-transparent"><i class="fas fa-long-arrow-alt-left"></i> Quay lại trang chủ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
