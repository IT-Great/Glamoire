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
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('handphone');
            $table->string('email');
            $table->string('company_name');
            $table->string('description');
            $table->boolean('bpom');
            $table->boolean('distributor');
            $table->boolean('reached_email');
            $table->string('category_product');
            $table->unsignedBigInteger('file_company');
            $table->foreign('file_company')->references('id')->on('file_partners')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('file_bpom');
            $table->foreign('file_bpom')->references('id')->on('file_partners')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};
