<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// トップページ (/) にアクセスしたら商品一覧へリダイレクト
Route::get('/', function () {
    return redirect()->route('products.index');
});

Auth::routes();

Route::get('/home', function () {
    return redirect()->route('products.index');
});

// ログインしているユーザーのみアクセス可能なルーティング群
Route::group(['middleware' => 'auth'], function () {
    // 商品関連のCRUD機能（一覧、新規登録、詳細、編集、更新、削除）
    Route::resource('products', ProductController::class);
});