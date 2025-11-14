@extends('layouts.client.client')

@section('title', 'Thanh toán')

@section('breadcrumb', 'Thanh toán')

@section('content')

<div class="ltn__checkout-area mb-105">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__checkout-inner">
                    <div class="ltn__checkout-single-content mt-50">
                        <h4 class="title-2">Chi tiết thanh toán</h4>
                        <div class="select-address">
                            <div>
                                <h6>Chọn địa chỉ khác:</h6>
                            </div>
                            <div>
                                <select name="address_id" id="list_address" class="input-item">
                                    @foreach ($addresses as $address)
                                    <option value="{{ $address->id }}" {{ $address->default ? 'selected' : '' }}>
                                        {{ $address->full_name }} - {{ $address->address }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <a href="{{ route('account.index') }}" class="btn theme-btn-1 btn-effect-1 text-uppercase">Thêm địa chỉ mới</a>
                            </div>
                        </div>
                        <div class="ltn__checkout-single-content-info">
                            <form action="#">
                                <h6>Thông tin cá nhân</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-item input-item-name ltn__custom-icon">
                                            <input type="text" name="ltn__name" placeholder="Nhập họ và tên" value="{{ $defaultAddress->full_name }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-item input-item-phone ltn__custom-icon">
                                            <input type="text" name="ltn__phone" placeholder="Nhập số điện thoại" value="{{ $defaultAddress->phone }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Địa chỉ</h6>
                                        <div class="input-item">
                                            <input type="text" name="ltn__address" placeholder="Nhập số nhà và tên đường" value="{{ $defaultAddress->address }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Thành phố</h6>
                                        <div class="input-item">
                                            <input type="text" name="ltn__city" placeholder="Nhập thành phố" value="{{ $defaultAddress->city }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ltn__checkout-payment-method mt-50">
                    <h4 class="title-2">Phương thức thanh toán</h4>
                    <div id="checkout_payment">
                        <!-- card -->
                        <div class="card">
                            <h5 class="ltn__card-title">
                                <input type="radio" name="payment_method" value="cash" id="payment_cod" checked>
                                <label for="payment_cod">
                                    Thanh toán khi nhận hàng <img src="{{ asset('assets/client/img/icons/cash.png') }}" alt="#">
                                </label>
                            </h5>
                        </div>
                        <!-- card -->
                        <div class="card">
                            <h5 class="collapsed ltn__card-title">
                                <input type="radio" name="payment_method" value="paypal" id="payment_paypal" checked>
                                <label for="payment_paypal">
                                    PayPal <img src="{{ asset('assets/client/img/icons/payment-3.png') }}" alt="#">
                                </label>
                            </h5>
                        </div>
                    </div>
                    <div class="ltn__payment-note mt-30 mb-30">
                        <p>Dữ liệu cá nhân của bạn sẽ được sử dụng để xử lý đơn hàng của bạn, hỗ trợ trải nghiệm của bạn trên toàn bộ trang web này và cho các mục đích khác được mô tả trong chính sách bảo mật của chúng tôi.</p>
                    </div>
                    <button class="btn theme-btn-1 btn-effect-1 text-uppercase" type="submit">Đặt hàng</button>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping-cart-total mt-50">
                    <h4 class="title-2">Tổng sản phẩm</h4>
                    <table class="table">
                        <tbody>
                            @foreach ($cartItems as $item)
                            <tr>
                                <td>{{ $item->product->name }} <strong>x {{ $item->quantity }}</strong></td>
                                <td>{{ number_format(num: $item->product->price * $item->quantity, decimals: 0, decimal_separator: ',', thousands_separator: '.') }} đ</td>
                                <td></td>
                            </tr>
                            @endforeach

                            <tr>
                                <td>Vận chuyển và xử lý</td>
                                <td>{{ number_format(num: 25000, decimals: 0, decimal_separator: ',', thousands_separator: '.') }} đ</td>
                            </tr>

                            <tr>
                                <td><strong>Tổng tiền</strong></td>
                                <td><strong class="totalPrice_checkout">{{ number_format(num: $totalPrice + 25000, decimals: 0, decimal_separator: ',', thousands_separator: '.') }} đ</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection