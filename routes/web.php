<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;


// トップおよび /home へのアクセスは商品一覧へ転送
Route::redirect('/', '/products');
Route::redirect('/home', '/products');

// 認証ルーティング (ログイン・会員登録等)
Auth::routes();

// 商品管理機能 (要ログインにする場合は auth ミドルウェアで囲む)
Route::resource('products', ProductController::class);