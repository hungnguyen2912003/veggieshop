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
                                <tr>
                                    <td class="cart-product-remove">x</td>
                                    <td class="cart-product-image">
                                        <a href="product-details.html"><img src="{{ asset('assets/client/img/product/1.png') }}" alt="#"></a>
                                    </td>
                                    <td class="cart-product-info">
                                        <h4><a href="product-details.html">Vegetables Juices</a></h4>
                                    </td>
                                    <td class="cart-product-price">$149.00</td>
                                    <td class="cart-product-quantity">
                                        <div class="cart-plus-minus">
                                            <input type="text" value="02" name="qtybutton" class="cart-plus-minus-box">
                                        </div>
                                    </td>
                                    <td class="cart-product-subtotal">$298.00</td>
                                </tr>
                                <tr>
                                    <td class="cart-product-remove">x</td>
                                    <td class="cart-product-image">
                                        <a href="product-details.html"><img src="{{ asset('assets/client/img/product/2.png') }}" alt="#"></a>
                                    </td>
                                    <td class="cart-product-info">
                                        <h4><a href="product-details.html">Orange Sliced Mix</a></h4>
                                    </td>
                                    <td class="cart-product-price">$85.00</td>
                                    <td class="cart-product-quantity">
                                        <div class="cart-plus-minus">
                                            <input type="text" value="02" name="qtybutton" class="cart-plus-minus-box">
                                        </div>
                                    </td>
                                    <td class="cart-product-subtotal">$170.00</td>
                                </tr>
                                <tr>
                                    <td class="cart-product-remove">x</td>
                                    <td class="cart-product-image">
                                        <a href="product-details.html"><img src="{{ asset('assets/client/img/product/3.png') }}" alt="#"></a>
                                    </td>
                                    <td class="cart-product-info">
                                        <h4><a href="product-details.html">Red Hot Tomato</a></h4>
                                    </td>
                                    <td class="cart-product-price">$75.00</td>
                                    <td class="cart-product-quantity">
                                        <div class="cart-plus-minus">
                                            <input type="text" value="02" name="qtybutton" class="cart-plus-minus-box">
                                        </div>
                                    </td>
                                    <td class="cart-product-subtotal">$150.00</td>
                                </tr>
                                <tr class="cart-coupon-row">
                                    <td colspan="6">
                                        <div class="cart-coupon">
                                            <input type="text" name="cart-coupon" placeholder="Coupon code">
                                            <button type="submit" class="btn theme-btn-2 btn-effect-2">Apply Coupon</button>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="submit" class="btn theme-btn-2 btn-effect-2-- disabled">Update Cart</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="shoping-cart-total mt-50">
                        <h4>Cart Totals</h4>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Cart Subtotal</td>
                                    <td>$618.00</td>
                                </tr>
                                <tr>
                                    <td>Shipping and Handing</td>
                                    <td>$15.00</td>
                                </tr>
                                <tr>
                                    <td>Vat</td>
                                    <td>$00.00</td>
                                </tr>
                                <tr>
                                    <td><strong>Order Total</strong></td>
                                    <td><strong>$633.00</strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="btn-wrapper text-right text-end">
                            <a href="/checkout" class="theme-btn-1 btn btn-effect-1">Proceed to checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection