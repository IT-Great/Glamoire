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
        Schema::create('shipping_fees', function (Blueprint $table) {
            $table->id();
            $table->string('code');             // Shipping company code, e.g., 'jne'
            $table->string('name');             // Shipping company name, e.g., 'Jalur Nugraha Ekakurir (JNE)'
            $table->string('service');          // Service type, e.g., 'JTR', 'REG', 'YES'
            $table->string('description');      // Service description, e.g., 'JNE Trucking'
            $table->integer('cost_value');      // Cost value, e.g., 95000, 21000, 25000
            $table->string('etd');              // Estimated delivery time, e.g., '8-9'
            $table->text('note')->nullable();   // Any additional notes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_fees');
    }
};
