<?php

use App\Http\Controllers\User\UserController;
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


Route::prefix('user')->name('user.')->group(function(){

    // PreventBackHistoryはミドルウェアでloguin処理後に戻るボタンでフォームに戻らないようにする
    Route::middleware(['guest','PreventBackHistory'])->group(function(){
        Route::view('/login','dashboard.user.login')->name('login');
        Route::view('/register','dashboard.user.register')->name('register');
        // 会員登録処理
        Route::post('/create',[UserController::class,'create'])->name('create');
        // ログイン処理
        Route::post('/check',[UserController::class,'check'])->name('check');
    });


    Route::middleware(['auth','PreventBackHistory'])->group(function(){
        Route::view('/home','dashboard.user.home')->name('home');
        Route::post('/logout',[UserController::class,'logout'])->name('logout');

    });
});