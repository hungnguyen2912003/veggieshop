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
                    <div id="loading-spinner">
                        <div class="loader"></div>
                    </div>
                    <div class="tab-pane fade active show" id="liton_product_grid">
                        @include('client.components.product-grid', ['products' => $products])
                    </div>
                </div>
                <div class="ltn__pagination-area text-center">
                    <div class="ltn__pagination">
                        {!! $products->links('client.components.pagination.pagination_custom') !!}
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
                            <li><a href="javascript:void(0)" data-id="{{ $category->id }}" class="category-filter">{{ $category->name }} <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
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
                                        <a href="{{ route('products.detail', $product->slug) }}"><img src="{{ $product->image_url }}" alt="{{ $product->name }}"></a>
                                    </div>
                                    <div class="top-rated-product-info">
                                        <div class="product-ratting">
                                            <ul>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <h6><a href="{{ route('products.detail', $product->slug) }}">{{ $product->name }}</a></h6>
                                        <div class="product-price">
                                            <span>{{ number_format($product->price, 0, ',', '.') }} VNĐ</span>
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
                        {{-- <ul>
                            @foreach ($tags as $tag)
                            <li><a href="#">{{ $tag->name }}</a></li>
                            @endforeach
                        </ul> --}}
                    </div>
                    <!-- Banner Widget -->
                    <div class="widget ltn__banner-widget">
                        <a href="{{ route('products.index') }}"><img src="{{ asset('assets/client/img/banner/banner-1.jpg') }}" alt="#"></a>
                    </div>

                </aside>
            </div>
        </div>
    </div>
</div>

@endsection