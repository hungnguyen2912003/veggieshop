<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\AuthController;

Route::get('/', function () {
    return view('client.pages.home');
})->name('home');

Route::controller(AuthController::class)
    ->prefix('register')
    ->name('register.')
    ->group(function () {
        Route::get('/', 'showRegistrationForm')->name('form');
        Route::post('/', 'register')->name('post');
        Route::get('/success', 'showSuccess')->name('success');
        Route::post('/resend', 'resendActivation')->name('resend');
    });

Route::get('/activate/{token}', [AuthController::class, 'activate'])->name('activate.account');


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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
