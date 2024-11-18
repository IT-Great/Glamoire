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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id'); 
            $table->unsignedBigInteger('order_id'); // Foreign key to orders table
            $table->string('payment_method'); // e.g., 'credit_card', 'paypal', 'bank_transfer'
            $table->string('transaction_id')->nullable(); // ID from the payment gateway
            $table->bigInteger('amount'); // Amount paid
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending'); // Payment status
            $table->timestamp('payment_date')->nullable(); // Date of payment
            $table->timestamps();
            
            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
