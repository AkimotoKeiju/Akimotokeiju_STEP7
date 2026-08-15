<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * リクエストの実行権限を判定
     */
    public function authorize(): bool
    {
        return true; // 必ず true に変更
    }

    /**
     * 仕様書に基づくバリデーションルール
     */
    public function rules(): array
    {
        return [
            'product_name' => ['required', 'string', 'max:255'],
            'company_id'   => ['required', 'exists:companies,id'],
            'price'        => ['required', 'integer', 'min:0'],
            'stock'        => ['required', 'integer', 'min:0'],
            'comment'      => ['nullable', 'string'],
            'img_path'     => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    /**
     * 属性名の日本語化（エラーメッセージ用）
     */
    public function attributes(): array
    {
        return [
            'product_name' => '商品名',
            'company_id'   => 'メーカー名',
            'price'        => '価格',
            'stock'        => '在庫数',
            'comment'      => 'コメント',
            'img_path'     => '商品画像',
        ];
    }
}