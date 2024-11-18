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
        Schema::create('promo_tiers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('promo_id');
            $table->foreign('promo_id')->references('id')->on('promos')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('tier_level');
            $table->integer('min_quantity');
            $table->bigInteger('discount_value')->nullable();
            $table->bigInteger('package_price')->nullable();
            $table->enum('discount_type', ['percentage', 'nominal', 'package']);
            $table->decimal('discount_percentage')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promo_tiers');
    }
};
