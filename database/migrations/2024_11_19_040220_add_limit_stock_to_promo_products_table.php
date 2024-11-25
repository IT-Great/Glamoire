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
            $table->integer('limit_stock')->nullable()->after('discounted_price'); // Ganti 'column_name' dengan kolom sebelum 'limit_stock'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('promo_products', function (Blueprint $table) {
            $table->dropColumn('limit_stock');
        });
    }
};
