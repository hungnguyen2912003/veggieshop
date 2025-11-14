<div class="ltn__utilize-menu-head">
    <span class="ltn__utilize-menu-title">Cart</span>
    <button class="ltn__utilize-close">×</button>
</div>
<div class="mini-cart-product-area ltn__scrollbar">
    @php
        $subtotal = 0;   
    @endphp
    @if (!empty($cartItems) && count($cartItems) > 0)
        @foreach ($cartItems as $item)
        @php
            $product = auth()->check() ? $item->product : \App\Models\Product::find($item['product_id']);
            $quantity = auth()->check() ? $item->quantity : $item['quantity'];
            $subtotal += $product->price * $quantity;
        @endphp
            <div class="mini-cart-item clearfix">
                <div class="mini-cart-img">
                    <a href="#"><img src="{{ asset($product->images->first()->image_path ?? asset('storage/uploads/products/default-product.png')) }}" alt="Image"></a>
                    <span class="mini-cart-item-delete"
                        data-id="{{ auth()->check() ? $item->id : $item['product_id'] }}">
                        <i class="icon-cancel"></i>
                    </span>
                </div>
                <div class="mini-cart-info">
                    <h6><a href="{{ route('products.detail', $product->slug) }}">{{ $product->name }}</a></h6>
                    <span class="mini-cart-quantity">{{ $quantity }} x {{ number_format($product->price, 0, ',', '.') }} VNĐ</span>
                </div>
            </div>
        @endforeach
    @else
        <div class="text-center py-4">
            <img src="{{ asset('assets/client/img/empty-cart.png') }}" alt="Empty Cart" width="80" class="mb-3">
            <p class="text-muted">Giỏ hàng của bạn đang trống</p>
        </div>
    @endif
</div>
<div class="mini-cart-footer">
    <div class="mini-cart-sub-total">
        <h5>Tổng tiền: <span>{{ number_format($subtotal, 0, ',', '.') }} VNĐ</span></h5>
    </div>
    <div class="btn-wrapper">
        <a href="{{ route('cart') }}" class="theme-btn-1 btn btn-effect-1">Xem</a>
        <a href="{{ route('checkout') }}" class="theme-btn-2 btn btn-effect-2">Thanh toán</a>
    </div>
</div>