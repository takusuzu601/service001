<?php

use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;


Route::prefix('user')->name('user.')->group(function () {

    //PreventBackHistoryはミドルウェアで設定 戻るボタンとキャッシュを無効化
    Route::middleware(['guest:web','PreventBackHistory'])->group(function () {
        Route::view('/login', 'dashboard.user.login')->name('login');
        Route::view('/register', 'dashboard.user.register')->name('register');
        // 会員登録処理
        Route::post('/create', [UserController::class, 'create'])->name('create');
        // ログイン処理
        Route::post('/check', [UserController::class, 'check'])->name('check');
          // メール認証処理
        Route::get('/verify', [UserController::class, 'verify'])->name('verify');
    });


    Route::middleware(['auth:web','is_user_verify_email','PreventBackHistory'])->group(function () {
        Route::view('/home', 'dashboard.user.home')->name('home');
        Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    });
});