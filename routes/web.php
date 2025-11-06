<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\ForgotPasswordController;
use App\Http\Controllers\Client\ResetPasswordController;
use App\Http\Controllers\Client\AccountController;
use App\Http\Controllers\Client\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');


// guest routes for authentication

Route::middleware('guest')->group(function () {
    Route::controller(AuthController::class)
        ->prefix('register')
        ->name('register.')
        ->group(function () {
            Route::get('/', 'showRegistrationForm')->name('form');
            Route::post('/', 'register')->name('post');
            Route::get('/success', 'showSuccess')->name('success');
            Route::post('/resend', 'resendActivation')->name('resend');
        });
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');
});

// authenticated routes for account activation and logout
Route::get('/activate/{token}', [AuthController::class, 'activate'])->name('activate.account');


Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('account')->name('account.')->group(function () {
        Route::get('/', [AccountController::class, 'index'])->name('index');
        Route::post('/update', [AccountController::class, 'update'])->name('update');
        Route::post('/change-password', [AccountController::class, 'changePassword'])->name('change-password');
        Route::post('/addresses', [AccountController::class, 'addAddress'])->name('addresses.add');
        Route::put('/addresses/{id}', [AccountController::class, 'updatePrimaryAddress'])->name('addresses.update');
        Route::delete('/addresses/{id}', [AccountController::class, 'deleteAddress'])->name('addresses.delete');
    });
});

Route::get('/about', function () {
    return view('client.page.about');
})->name('about');
Route::get('/shop', function () {
    return view('client.page.shop');
})->name('shop');
Route::get('/contact', function () {
    return view('client.page.contact');
})->name('contact');
Route::get('/service', function () {
    return view('client.page.service');
})->name('service');
Route::get('/team', function () {
    return view('client.page.team');
})->name('team');
Route::get('/faq', function () {
    return view('client.page.faq');
})->name('faq');
