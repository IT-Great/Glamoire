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
        Schema::table('questions', function (Blueprint $table) {
            $table->string('response_image')->nullable()->after('response'); // Menambahkan kolom response_image
            $table->string('response_video')->nullable()->after('response_image'); // Menambahkan kolom response_video
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn(['response_image', 'response_video']); // Menghapus kolom jika di-rollback
        });
    }
};
