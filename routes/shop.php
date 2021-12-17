<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shop\ShopController;

Route::prefix('shop')->name('shop.')->group(function () {

    Route::middleware(['guest:shop', 'PreventBackHistory'])->group(function () {
        Route::view('/login', 'dashboard.shop.login')->name('login');
        Route::view('/register', 'dashboard.shop.register')->name('register');
        // 会員登録処理
        Route::post('/create', [ShopController::class, 'create'])->name('create');
        // ログイン処理
        Route::post('/check', [ShopController::class, 'check'])->name('check');
        // メール認証処理
        Route::get('/verify', [ShopController::class, 'verify'])->name('verify');
    });
    Route::middleware(['auth:shop', 'is_shop_verify_email', 'PreventBackHistory'])->group(function () {
        Route::view('/home', 'dashboard.shop.home')->name('home');
        Route::post('/logout', [ShopController::class, 'logout'])->name('logout');
    });
});
