@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">商品一覧画面</h1>

    {{-- 検索フォーム --}}
    <form action="{{ route('products.index') }}" method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="text" name="search_name" class="form-control" placeholder="検索キーワード" value="{{ request('search_name') }}">
        </div>
        <div class="col-md-4">
            <select name="search_company" class="form-select">
                <option value="">メーカーを選択</option>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}" {{ request('search_company') == $company->id ? 'selected' : '' }}>
                        {{ $company->company_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-outline-secondary">検索</button>
        </div>
    </form>

    {{-- 新規登録ボタン --}}
    <div class="mb-3">
        <a href="{{ route('products.create') }}" class="btn btn-warning">新規登録</a>
    </div>

    {{-- 商品一覧テーブル --}}
    <table class="table table-striped align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>商品画像</th>
                <th>商品名</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>メーカー名</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>
                        @if($product->img_path)
                            <img src="{{ asset('storage/' . $product->img_path) }}" alt="商品画像" width="50">
                        @else
                            <span>なし</span>
                        @endif
                    </td>
                    <td>{{ $product->product_name }}</td>
                    <td>¥{{ number_format($product->price) }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->company->company_name ?? '' }}</td>
                    <td>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">詳細</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('本当に削除しますか？');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection