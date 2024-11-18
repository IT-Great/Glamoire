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
        Schema::create('product_variations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('sku')->unique(); // Menambahkan kolom SKU
            $table->string('variant_type');
            $table->string('variant_value');
            $table->text('use_variant_image')->nullable();
            $table->text('variant_image')->nullable(); // Untuk menyimpan gambar varian jika diperlukan
            $table->string('variant_stock')->nullable();
            $table->bigInteger('variant_price')->nullable();
            $table->string('weight_variant')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variations');
    }
};
