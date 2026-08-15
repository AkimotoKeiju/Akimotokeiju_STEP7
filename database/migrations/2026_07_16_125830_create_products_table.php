<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // companiesテーブルのIDと紐付ける外部キー（必須）
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->string('product_name'); // 商品名（必須）
            $table->integer('price'); // 価格（必須）
            $table->integer('stock'); // 在庫数（必須）
            $table->text('comment')->nullable(); // 詳細・評価（空でもOK）
            $table->string('img_path')->nullable(); // 画像のパス（空でもOK）
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
