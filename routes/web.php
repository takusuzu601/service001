<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Oner\OnerController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('user')->name('user.')->group(function () {

    //PreventBackHistoryはミドルウェアで設定 戻るボタンとキャッシュを無効化
    Route::middleware(['guest:web', 'PreventBackHistory'])->group(function () {
        Route::view('/login', 'dashboard.user.login')->name('login');
        Route::view('/register', 'dashboard.user.register')->name('register');
        // 会員登録処理
        Route::post('/create', [UserController::class, 'create'])->name('create');
        // ログイン処理
        Route::post('/check', [UserController::class, 'check'])->name('check');
        // メール認証処理
        Route::get('/verify', [UserController::class, 'verify'])->name('verify');
    });


    Route::middleware(['auth:web', 'is_user_verify_email', 'PreventBackHistory'])->group(function () {
        Route::view('/home', 'dashboard.user.home')->name('home');
        Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    });
});

Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware(['guest:admin', 'PreventBackHistory'])->group(function () {
        Route::view('/login', 'dashboard.admin.login')->name('login');
        Route::post('check', [AdminController::class, 'check'])->name('check');
    });
    Route::middleware(['auth:admin', 'PreventBackHistory'])->group(function () {
        Route::view('/home', 'dashboard.admin.home')->name('home');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    });
});

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
