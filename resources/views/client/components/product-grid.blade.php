<div class="col-xl-4 col-sm-6 col-6">
    <div class="ltn__product-item ltn__product-item-3 text-center">
        <div class="product-img">
            <a href="javascript:void(0)"><img src="{{ $product->image_url }}" alt="{{ $product->name }}"></a>
            <div class="product-badge">
                <ul>
                    <li class="sale-badge">Mới</li>
                </ul>
            </div>
            <div class="product-hover-action">
                <ul>
                    <li>
                        <a href="javascript:void(0)" title="Xem chi tiết" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                            <i class="far fa-eye"></i>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" title="Thêm vào giỏ hàng" data-bs-toggle="modal" data-bs-target="#add_to_cart_modal">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" title="Thêm vào danh sách yêu thích" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                            <i class="far fa-heart"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="product-info">
            <div class="product-ratting">
                <ul>
                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                    <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                    <li><a href="#"><i class="far fa-star"></i></a></li>
                </ul>
            </div>
            <h2 class="product-title"><a href="javascript:void(0)">{{ $product->name }}</a></h2>
            <div class="product-price">
                <span>{{ number_format($product->price, 0, ',', '.') }} VNĐ</span>
            </div>
        </div>
    </div>
</div>