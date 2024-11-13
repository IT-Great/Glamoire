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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('shipping_address_id');
            $table->foreign('shipping_address_id')->references('id')->on('shipping_addresses')->onDelete('cascade');
            $table->unsignedBigInteger('total_item');
            $table->unsignedBigInteger('total_item_price');
            // $table->unsignedBigInteger('payment_id');
            // $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');
            $table->bigInteger('shipping_cost');
            $table->string('voucher_promo')->nullable();
            $table->string('voucher_ongkir')->nullable();
            $table->bigInteger('discount_ongkir')->nullable();
            $table->bigInteger('discount_amount')->nullable();
            $table->bigInteger('total_amount');
            $table->date('order_date');
            // $table->unsignedBigInteger('invoice_id')->nullable();
            // $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
            $table->enum('status', ['waiting confirm', 'in process', 'in delivery', 'done'])
                ->default('waiting confirm');
            $table->string('kurir')->nullable();
            $table->string('resi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
