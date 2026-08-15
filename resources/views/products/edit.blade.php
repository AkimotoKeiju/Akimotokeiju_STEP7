@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">商品情報編集画面</h1>

    {{-- エラー表示 --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <strong>ID:</strong> {{ $product->id }}
        </div>

        <div class="mb-3">
            <label class="form-label">商品名 <span class="text-danger">*</span></label>
            <input type="text" name="product_name" class="form-control" value="{{ old('product_name', $product->product_name) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">メーカー名 <span class="text-danger">*</span></label>
            <select name="company_id" class="form-select">
                @foreach($companies as $company)
                    <option value="{{ $company->id }}" {{ old('company_id', $product->company_id) == $company->id ? 'selected' : '' }}>
                        {{ $company->company_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">価格 <span class="text-danger">*</span></label>
            <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">在庫数 <span class="text-danger">*</span></label>
            <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">コメント</label>
            <textarea name="comment" class="form-control" rows="3">{{ old('comment', $product->comment) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">商品画像</label><br>
            @if($product->img_path)
                <img src="{{ asset('storage/' . $product->img_path) }}" alt="商品画像" width="100" class="mb-2"><br>
            @endif
            <input type="file" name="img_path" class="form-control">
        </div>

        <button type="submit" class="btn btn-warning">更新</button>
        <a href="{{ route('products.show', $product->id) }}" class="btn btn-secondary">戻る</a>
    </form>
</div>
@endsection