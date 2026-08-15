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
     * 売上とのリレーション (1対多)
     */
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    /**
     * 商品一覧の取得および検索処理
     */
    public function getListWithSearch($searchName = null, $searchCompany = null)
    {
        $query = $this->with('company');

        // 商品名による曖昧検索
        if (!empty($searchName)) {
            $query->where('product_name', 'LIKE', "%{$searchName}%");
        }

        // メーカーによる完全一致検索
        if (!empty($searchCompany)) {
            $query->where('company_id', $searchCompany);
        }

        return $query->get();
    }
}