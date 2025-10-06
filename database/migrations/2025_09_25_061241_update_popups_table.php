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
            // Ubah kolom image_popup → media_popup
            $table->renameColumn('image_popup', 'media_popup');

            // Tambahkan kolom baru
            $table->enum('media_type', ['image', 'video'])->default('image')->after('media_popup');
            $table->enum('display_type', ['popup', 'slider', 'both'])->default('popup')->after('media_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('popups', function (Blueprint $table) {
            // Balikkan perubahan
            $table->renameColumn('media_popup', 'image_popup');
            $table->dropColumn(['media_type', 'display_type']);
        });
    }
};
