<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('client.pages.home');
});

Route::get('/about', function () {
    return view('client.pages.about');
});

Route::get('/contact', function () {
    return view('client.pages.contact');
});

Route::get('/shop', function () {
    return view('client.pages.shop');
});

Route::get('/product/{id}', function ($id) {
    return view('client.pages.product', ['id' => $id]);
});

Route::get('/cart', function () {
    return view('client.pages.cart');
});

Route::get('/product-detail', function () {
    return view('client.pages.product-detail');
});

Route::get('/checkout', function () {
    return view('client.pages.checkout');
});

Route::get('/login', function () {
    return view('client.pages.login');
});

Route::get('/register', function () {
    return view('client.pages.register');
});

Route::get('/account', function () {
    return view('client.pages.account');
});

Route::get('/faq', function () {
    return view('client.pages.faq');
});

Route::get('/wishlist', function () {
    return view('client.pages.wishlist');
});

Route::get('/team', function () {
    return view('client.pages.team');
});

Route::get('/service', function () {
    return view('client.pages.service');
});

Route::get('/404', function () {
    return view('client.pages.404');
});
