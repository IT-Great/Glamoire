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
        Schema::table('cart_items', function (Blueprint $table) {
            Schema::table('cart_items', function (Blueprint $table) {
                // Menambahkan foreign key untuk 'product_variant_id'
                $table->foreign('product_variant_id')
                      ->references('id')
                      ->on('product_variations')
                      ->cascadeOnDelete()   // Jika data di 'product_variations' dihapus, hapus juga di 'cart_items'
                      ->cascadeOnUpdate();  // Jika data di 'product_variations' diperbarui, perbarui juga di 'cart_items'
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
