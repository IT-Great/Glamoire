<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('promo_gift_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('promo_id');
            $table->unsignedBigInteger('main_product_id'); // Produk utama yang dibeli
            $table->unsignedBigInteger('gift_product_id'); // Produk hadiah
            $table->integer('main_product_quantity')->default(1); // Minimal pembelian produk utama
            $table->integer('gift_product_quantity')->default(1); // Jumlah hadiah yang diberikan
            $table->integer('limit_stock')->nullable(); // Batasan stok untuk promo ini
            $table->foreign('promo_id')->references('id')->on('promos')->onDelete('cascade');
            $table->foreign('main_product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('gift_product_id')->references('id')->on('products')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promo_gift_products');
    }
};
