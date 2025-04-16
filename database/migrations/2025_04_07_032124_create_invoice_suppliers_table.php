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
        Schema::create('invoice_suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('no_invoice')->unique();
            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('supplier_data')->cascadeOnDelete()->cascadeOnUpdate();
            $table->bigInteger('amount');
            $table->integer('pph')->nullable();
            $table->integer('pph_percentage')->nullable();
            $table->dateTime('date')->default(now());
            $table->string('nota')->nullable();
            $table->dateTime('deadline_invoice')->default(now());
            $table->enum('payment_status', ['Paid', 'Not Yet'])->default('Not Yet');
            $table->string('payment_method')->nullable();

            $table->unsignedBigInteger('kredit_coa_id')->nullable();
            $table->foreign('kredit_coa_id')->references('id')->on('coas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('debit_coa_id')->nullable();
            $table->foreign('debit_coa_id')->references('id')->on('coas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('old_kredit_coa_id')->nullable();
            $table->foreign('old_kredit_coa_id')->references('id')->on('coas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('new_kredit_coa_id')->nullable();
            $table->foreign('new_kredit_coa_id')->references('id')->on('coas')->cascadeOnDelete()->cascadeOnUpdate();

            $table->string('description')->nullable();
            $table->string('image_invoice')->nullable();
            $table->string('image_proof')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_suppliers');
    }
};
