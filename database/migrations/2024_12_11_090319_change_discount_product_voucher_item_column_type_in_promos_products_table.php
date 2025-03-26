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
        Schema::table('promo_products', function (Blueprint $table) {
            $table->bigInteger('discount_product_voucher_item')->change(); // Gunakan decimal jika perlu menyimpan nilai seperti 20.50
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('promo_products', function (Blueprint $table) {
            $table->bigInteger('discount_product_voucher_item')->change(); // Kembalikan ke string jika rollback

        });
    }
};
