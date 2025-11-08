@extends('layouts.client.client')

@section('title', 'Cart')

@section('breadcrumb', 'Cart')

@section('content')
<div class="liton__shoping-cart-area mb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping-cart-inner">
                    <div class="shoping-cart-table table-responsive">
                        <table class="table">
                            <tbody>
                                @php
                                    $cartTotal = 0;
                                @endphp
                                @forelse ($cartItems as $item)
                                    @php
                                        $subtotal = $item['price'] * $item['quantity'];
                                        $cartTotal += $subtotal;
                                    @endphp
                                    <tr>
                                        <td class="cart-product-remove">x</td>
                                        <td class="cart-product-image">
                                            <a href="javascript:void(0)">
                                                <img src="{{ asset($item['image'] ?? 'storage/uploads/products/default-product.png') }}" alt="{{ $item['name'] }}">
                                            </a>
                                        </td>
                                        <td class="cart-product-info">
                                            <h4><a href="javascript:void(0)">{{ $item['name'] }}</a></h4>
                                        </td>
                                        <td class="cart-product-price">{{ number_format($item['price'], 0, ',', '.') }} VNĐ</td>
                                        <td class="cart-product-quantity">
                                            <div class="cart-plus-minus">
                                                <button class="qtybutton dec">-</button>
                                                <input type="text" value="{{ $item['quantity'] }}"
                                                       class="cart-plus-minus-box" readonly data-max="{{ $item['stock'] }}" data-id="{{ $item['product_id'] }}">
                                                <button class="qtybutton inc">+</button>
                                            </div>
                                        </td>
                                        <td class="cart-product-subtotal">{{ number_format($subtotal, 0, ',', '.') }} VNĐ</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Giỏ hàng trống</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if (!empty($cartItems) && count($cartItems) > 0)
                    <div class="shoping-cart-total mt-50">
                        <h4>Tổng giỏ hàng</h4>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Tổng tiền</td>
                                    <td><span class="cart-total">{{ number_format($cartTotal, 0, ',', '.') }} VNĐ</span></td>
                                </tr>
                                <tr>
                                    <td>Phí vận chuyển</td>
                                    <td>{{ number_format(0, 0, ',', '.') }} VNĐ</td>
                                </tr>
                                <tr>
                                    <td><strong>Tổng thanh toán</strong></td>
                                    <td><strong><span class="cart-grand-total">{{ number_format($cartTotal, 0, ',', '.') }} VNĐ</span></strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="btn-wrapper text-end">
                            <a href="javascript:void(0)" class="theme-btn-1 btn btn-effect-1">Thanh toán</a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection