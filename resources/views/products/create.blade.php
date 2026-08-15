@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">商品新規登録画面</h1>

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

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">商品名 <span class="text-danger">*</span></label>
            <input type="text" name="product_name" class="form-control" value="{{ old('product_name') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">メーカー名 <span class="text-danger">*</span></label>
            <select name="company_id" class="form-select">
                <option value="">選択してください</option>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                        {{ $company->company_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">価格 <span class="text-danger">*</span></label>
            <input type="number" name="price" class="form-control" value="{{ old('price') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">在庫数 <span class="text-danger">*</span></label>
            <input type="number" name="stock" class="form-control" value="{{ old('stock') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">コメント</label>
            <textarea name="comment" class="form-control" rows="3">{{ old('comment') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">商品画像</label>
            <input type="file" name="img_path" class="form-control">
        </div>

        <button type="submit" class="btn btn-warning">新規登録</button>
        <a href="{{ route('products.create') }}" class="btn btn-secondary">戻る</a>
    </form>
</div>
@endsection