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
        Schema::create('notify_mes', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id'); 
            $table->unsignedBigInteger('product_id');
            $table->integer('product_variant_id')->nullable();
            $table->string('email');
            $table->boolean('status')->default(0);
            $table->date('send_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notify_mes');
    }
};
