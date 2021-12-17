<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Oner\OnerController;

Route::prefix('oner')->name('oner.')->group(function () {

    Route::middleware(['guest:oner', 'PreventBackHistory'])->group(function () {
        Route::view('/login', 'dashboard.oner.login')->name('login');
        Route::view('/register', 'dashboard.oner.register')->name('register');
        // 会員登録処理
        Route::post('/create', [OnerController::class, 'create'])->name('create');
        // ログイン処理
        Route::post('/check', [OnerController::class, 'check'])->name('check');
        // メール認証処理
        Route::get('/verify', [OnerController::class, 'verify'])->name('verify');
    });
    Route::middleware(['auth:oner', 'is_oner_verify_email', 'PreventBackHistory'])->group(function () {
        Route::view('/home', 'dashboard.oner.home')->name('home');
        Route::post('/logout', [OnerController::class, 'logout'])->name('logout');
    });
});
