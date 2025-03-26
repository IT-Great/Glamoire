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
        Schema::table('orders', function (Blueprint $table) {
            // Mengupdate kolom 'status' untuk menambahkan nilai 'delivery'
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled', 'failed', 'delivery'])
                ->default('pending')
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Jika rollback, kembalikan ke nilai enum sebelumnya
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled', 'failed'])
                ->default('pending')
                ->change();
        });
    }
};
