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
        Schema::create('rating_and_reviews', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id'); 
            $table->unsignedBigInteger('product_id');
            $table->integer('product_variant_id')->nullable();
            $table->unsignedBigInteger('order_id'); 
            $table->integer('rating');
            $table->string('description'); 
            $table->text('images')->nullable();
            $table->text('video')->nullable();
            $table->timestamps();
            
            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rating_and_reviews');
    }
};
