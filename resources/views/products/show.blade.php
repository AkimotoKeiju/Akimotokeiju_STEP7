@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">商品情報詳細画面</h1>

    <div class="mb-3">
        <strong>ID:</strong> {{ $product->id }}
    </div>
    <div class="mb-3">
        <strong>商品画像:</strong><br>
        @if($product->img_path)
            <img src="{{ asset('storage/' . $product->img_path) }}" alt="商品画像" width="150">
        @else
            <span>なし</span>
        @endif
    </div>
    <div class="mb-3">
        <strong>商品名:</strong> {{ $product->product_name }}
    </div>
    <div class="mb-3">
        <strong>メーカー:</strong> {{ $product->company->company_name ?? '' }}
    </div>
    <div class="mb-3">
        <strong>価格:</strong> ¥{{ number_format($product->price) }}
    </div>
    <div class="mb-3">
        <strong>在庫数:</strong> {{ $product->stock }}
    </div>
    <div class="mb-3">
        <strong>コメント:</strong> {{ $product->comment }}
    </div>

    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">編集</a>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
</div>
@endsection