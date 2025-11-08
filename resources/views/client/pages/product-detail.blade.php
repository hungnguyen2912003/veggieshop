@extends('layouts.client.client')

@section('title', 'Chi tiết sản phẩm')

@section('breadcrumb', 'Chi tiết sản phẩm')

@section('content')
<!-- SHOP DETAILS AREA START -->
<div class="ltn__shop-details-area pb-85">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="ltn__shop-details-inner mb-60">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="ltn__shop-details-img-gallery">
                                <div class="ltn__shop-details-large-img">
                                    <div class="single-large-img">
                                        @foreach ($product->images as $image)
                                        <a href="{{ asset('storage/uploads/products/' . $image->image) }}" data-rel="lightcase:myCollection">
                                            <img src="{{ asset('storage/uploads/products/' . $image->image) }}" alt="{{ $product->name }}">
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="ltn__shop-details-small-img slick-arrow-2">
                                    @foreach ($product->images as $image)
                                        <div class="single-small-img">
                                            <img src="{{ asset('storage/uploads/products/' . $image->image) }}" alt="{{ $product->name }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="modal-product-info shop-details-info pl-0">
                                <div class="product-ratting">
                                    <ul>
                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                        <li class="review-total"> <a href="#"> ( 95 Reviews )</a></li>
                                    </ul>
                                </div>
                                <h3>{{ $product->name }}</h3>
                                <div class="product-price">
                                    <span>{{ number_format($product->price, 0, ',', '.') }} VNĐ</span>
                                </div>
                                <div class="modal-product-meta ltn__product-details-menu-1">
                                    <ul>
                                        <li>
                                            <strong>Danh mục:</strong> 
                                            <span>
                                                <a href="javascript:void(0)" data-id="{{ $product->category->id }}" class="category-filter">{{ $product->category->name }}</a>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="ltn__product-details-menu-2">
                                    <ul>
                                        <li>
                                            <div class="cart-plus-minus">
                                                <input type="text" value="1" name="qtybutton" class="cart-plus-minus-box">
                                            </div>
                                        </li>
                                        <li>
                                            <a href="#" class="theme-btn-1 btn btn-effect-1 add-to-cart-btn" data-id="{{ $product->id }}" title="Thêm vào giỏ hàng" data-bs-toggle="modal" data-bs-target="#add_to_cart_modal">
                                                <i class="fas fa-shopping-cart"></i>
                                                <span>Thêm vào giỏ hàng</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="ltn__product-details-menu-3">
                                    <ul>
                                        <li>
                                            <a href="#" class="" title="Thêm vào danh sách yêu thích" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                                <i class="far fa-heart"></i>
                                                <span>Yêu thích</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <hr>
                                <div class="ltn__social-media">
                                    <ul>
                                        <li>Chia sẻ:</li>
                                        <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                                        <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                                <hr>
                                <div class="ltn__safe-checkout">
                                    <h5>Thanh toán an toàn</h5>
                                    <img src="{{ asset('assets/client/img/icons/payment-2.png') }}" alt="Payment Image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Shop Tab Start -->
                <div class="ltn__shop-details-tab-inner ltn__shop-details-tab-inner-2">
                    <div class="ltn__shop-details-tab-menu">
                        <div class="nav">
                            <a class="active show" data-bs-toggle="tab" href="#liton_tab_details_description">Mô tả</a>
                            <a data-bs-toggle="tab" href="#liton_tab_details_reviews" class="">Đánh giá</a>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="liton_tab_details_description">
                            <div class="ltn__shop-details-tab-content-inner">
                                <h4 class="title-2">{{ $product->description }}</h4>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="liton_tab_details_reviews">
                            <div class="ltn__shop-details-tab-content-inner">
                                <h4 class="title-2">Đánh giá</h4>
                                <div class="product-ratting">
                                    <ul>
                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                        <li class="review-total"> <a href="#"></a></li>
                                    </ul>
                                </div>
                                <hr>
                                <!-- comment-area -->
                                <div class="ltn__comment-area mb-30">
                                    <div class="ltn__comment-inner">
                                        <ul>
                                            <li>
                                                <div class="ltn__comment-item clearfix">
                                                    <div class="ltn__commenter-img">
                                                        <img src="{{ asset('assets/client/img/testimonial/1.jpg') }}" alt="Image">
                                                    </div>
                                                    <div class="ltn__commenter-comment">
                                                        <h6><a href="#">Adam Smit</a></h6>
                                                        <div class="product-ratting">
                                                            <ul>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                                <li><a href="#"><i class="far fa-star"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus, omnis fugit corporis iste magnam ratione.</p>
                                                        <span class="ltn__comment-reply-btn">September 3, 2020</span>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- comment-reply -->
                                <div class="ltn__comment-reply-area ltn__form-box mb-30">
                                    <form action="#">
                                        <h4 class="title-2">Thêm đánh giá</h4>
                                        <div class="mb-30">
                                            <div class="add-a-review">
                                                <h6>Đánh giá của bạn:</h6>
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-item input-item-textarea ltn__custom-icon">
                                            <textarea placeholder="Nhập đánh giá của bạn...."></textarea>
                                        </div>
                                        <div class="input-item input-item-name ltn__custom-icon">
                                            <input type="text" placeholder="Nhập tên của bạn....">
                                        </div>
                                        <div class="input-item input-item-email ltn__custom-icon">
                                            <input type="email" placeholder="Nhập email của bạn....">
                                        </div>
                                        <div class="input-item input-item-website ltn__custom-icon">
                                            <input type="text" name="website" placeholder="Nhập website của bạn....">
                                        </div>
                                        <label class="mb-0"><input type="checkbox" name="agree"> Lưu tên, email và website của tôi trong trình duyệt này để lần sau tôi bình luận.</label>
                                        <div class="btn-wrapper">
                                            <button class="btn theme-btn-1 btn-effect-1 text-uppercase" type="submit">Gửi</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Shop Tab End -->
            </div>
        </div>
    </div>
</div>
<!-- SHOP DETAILS AREA END -->

@include('client.components.includes.include-modals')

<!-- PRODUCT SLIDER AREA START -->
<div class="ltn__product-slider-area ltn__product-gutter pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2">
                    <h1 class="section-title">Sản phẩm liên quan<span>.</span></h1>
                </div>
            </div>
        </div>
        <div class="row ltn__related-product-slider-one-active slick-arrow-1">
            <!-- ltn__product-item -->
            @foreach ($relatedProducts as $relatedProduct)
            <div class="col-lg-12">
                <div class="ltn__product-item ltn__product-item-3 text-center">
                    <div class="product-img">
                        <a href="{{ route('products.detail', $relatedProduct->slug) }}"><img src="{{ $relatedProduct->image_url }}" alt="{{ $relatedProduct->name }}"></a>
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
                        <h2 class="product-title"><a href="{{ route('products.detail', $relatedProduct->slug) }}">{{ $relatedProduct->name }}</a></h2>
                        <div class="product-price">
                            <span>{{ number_format($relatedProduct->price, 0, ',', '.') }} VNĐ</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- PRODUCT SLIDER AREA END -->
@endsection