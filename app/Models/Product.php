<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'product_name',
        'price',
        'stock',
        'comment',
        'img_path',
    ];

    /**
     * メーカーとのリレーション (多対1)
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * 商品一覧の取得および検索処理
     */
    public function getListWithSearch($searchName = null, $searchCompany = null)
    {
        $query = $this->with('company');

        if (!empty($searchName)) {
            $query->where('product_name', 'LIKE', "%{$searchName}%");
        }

        if (!empty($searchCompany)) {
            $query->where('company_id', $searchCompany);
        }

        return $query->get();
    }

    /**
     * 商品詳細・1件取得
     */
    public function getDetail($id)
    {
        return $this->with('company')->findOrFail($id);
    }

    /**
     * 商品新規登録
     */
    public function registProduct($data)
    {
        return $this->create($data);
    }

    /**
     * 商品更新
     */
    public function updateProduct($data)
    {
        return $this->update($data);
    }

    /**
     * 商品削除
     */
    public function deleteProduct()
    {
        return $this->delete();
    }
}