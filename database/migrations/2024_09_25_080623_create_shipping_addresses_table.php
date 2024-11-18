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
        Schema::create('shipping_addresses', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id');
            $table->string('label');
            $table->string('recipient_name');
            $table->string('handphone');
            $table->string('province');
            $table->string('regency');
            $table->string('district');
            $table->string('address');
            $table->string('benchmark')->nullable();
            $table->boolean('is_main');
            $table->boolean('is_use');
            $table->integer('id_province');
            $table->integer('id_regency');
            $table->integer('id_district');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_addresses');
    }
};
