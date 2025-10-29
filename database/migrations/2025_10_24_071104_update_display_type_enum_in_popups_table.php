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
        Schema::table('popups', function (Blueprint $table) {
            $table->enum('display_type', [
                'popup',
                'slider',
                'banner',
                'popup&slider',
                'popup&banner',
                'slider&banner',
                'both'
            ])->default('popup')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('popups', function (Blueprint $table) {
            $table->enum('display_type', ['popup', 'slider', 'both'])->default('popup')->change();
        });
    }
};
