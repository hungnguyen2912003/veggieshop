@extends('layouts.client.client')
@section('title', 'Sản phẩm')
@section('breadcrumb', 'Sản phẩm')

@section('content')

<div class="ltn__product-area ltn__product-gutter">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 order-lg-2 mb-120">
                <div class="ltn__shop-options">
                    <ul>
                        <li>
                            <div class="ltn__grid-list-tab-menu ">
                                <div class="nav">
                                    <a class="active show" data-bs-toggle="tab" href="#liton_product_grid"><i class="fas fa-th-large"></i></a>
                                </div>
                            </div>
                        </li>
                        <li>
                           <div class="short-by text-center">
                                <select class="nice-select">
                                    <option value="default">Sắp xếp theo mặc định</option>
                                    <option value="newest">Sắp xếp theo mới nhất</option>
                                    <option value="price-asc">Sắp xếp theo giá: thấp đến cao</option>
                                    <option value="price-desc">Sắp xếp theo giá: cao đến thấp</option>
                                </select>
                            </div> 
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="liton_product_grid">
                        <div class="ltn__product-tab-content-inner ltn__product-grid-view">
                            <div class="row">
                                <!-- ltn__product-item -->
                                @include('client.components.product-grid')
                                <!--  -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ltn__pagination-area text-center">
                    <div class="ltn__pagination">
                        <ul>
                            <li><a href="#"><i class="fas fa-angle-double-left"></i></a></li>
                            <li><a href="#">1</a></li>
                            <li class="active"><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">...</a></li>
                            <li><a href="#">10</a></li>
                            <li><a href="#"><i class="fas fa-angle-double-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4  mb-120">
                <aside class="sidebar ltn__shop-sidebar">
                    <!-- Category Widget -->
                    <div class="widget ltn__menu-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border">Danh mục sản phẩm</h4>
                        <ul>
                            @foreach ($categories as $category)
                            <li><a href="{{ route('products.category', $category->slug) }}">{{ $category->name }} <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- Price Filter Widget -->
                    <div class="widget ltn__price-filter-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border">Lọc theo giá</h4>
                        <div class="price_filter">
                            <div class="price_slider_amount">
                                <input type="submit"  value="Khoảng giá:"/> 
                                <input type="text" class="amount" name="price"  placeholder="Thêm giá của bạn" /> 
                            </div>
                            <div class="slider-range"></div>
                        </div>
                    </div>
                    <!-- Top Rated Product Widget -->
                    <div class="widget ltn__top-rated-product-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border">Sản phẩm được yêu thích</h4>
                        <ul>
                            @foreach ($products as $product)
                            <li>
                                <div class="top-rated-product-item clearfix">
                                    <div class="top-rated-product-img">
                                        <a href="{{ route('product.detail', $product->slug) }}"><img src="{{ asset('storage/uploads/products/' . $product->image) }}" alt="{{ $product->name }}"></a>
                                    </div>
                                    <div class="top-rated-product-info">
                                        <div class="product-ratting">
                                            <ul>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <h6><a href="{{ route('product.detail', $product->slug) }}">{{ $product->name }}</a></h6>
                                        <div class="product-price">
                                            <span>{{ number_format($product->price, 0, ',', '.') }} VNĐ</span>
                                            <del>{{ number_format($product->price, 0, ',', '.') }} VNĐ</del>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- Search Widget -->
                    <div class="widget ltn__search-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border">Tìm kiếm sản phẩm</h4>
                        <form action="#">
                            <input type="text" name="search" placeholder="Tìm kiếm sản phẩm">
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    <!-- Tagcloud Widget -->
                    <div class="widget ltn__tagcloud-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border">Tags phổ biến</h4>
                        <ul>
                            @foreach ($tags as $tag)
                            <li><a href="#">{{ $tag->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- Banner Widget -->
                    <div class="widget ltn__banner-widget">
                        <a href="{{ route('products') }}"><img src="{{ asset('assets/client/img/banner/banner-1.jpg') }}" alt="#"></a>
                    </div>

                </aside>
            </div>
        </div>
    </div>
</div>

@endsection