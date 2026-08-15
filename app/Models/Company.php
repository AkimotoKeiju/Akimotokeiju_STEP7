<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    // 保存や更新を許可するカラムを指定
    protected $fillable = [
        'company_name',
        'street_address',
        'representative_name',
    ];

    // 「1つの会社は、複数の商品（Products）を持つ」という1対多のリレーションを定義
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}