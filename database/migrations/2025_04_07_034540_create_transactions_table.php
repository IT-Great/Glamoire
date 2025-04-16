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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kredit_coa_id');
            $table->foreign('kredit_coa_id')->references('id')->on('coas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('debit_coa_id');
            $table->foreign('debit_coa_id')->references('id')->on('coas')->cascadeOnDelete()->cascadeOnUpdate();                    
            $table->string('recipient_name')->nullable();
            $table->string('no_transaction')->unique();
            $table->bigInteger('amount');
            $table->dateTime('date')->default(now());
            $table->enum('type', ['transfer', 'receive']);
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
