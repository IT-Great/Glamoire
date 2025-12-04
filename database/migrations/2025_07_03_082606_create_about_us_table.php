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
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();

            // Hero Section
            $table->string('hero_title')->nullable();
            $table->text('hero_description')->nullable();
            $table->string('hero_image')->nullable();

            // Penjelasan Singkat Glamoire
            $table->string('intro_title')->nullable();
            $table->text('intro_description')->nullable();
            $table->string('intro_image')->nullable();
            $table->string('intro_video')->nullable(); // TAMBAHKAN INI

            // Visi
            $table->string('vision_title')->nullable();
            $table->text('vision_description')->nullable();
            $table->string('vision_image')->nullable();
            $table->string('vision_video')->nullable(); // TAMBAHKAN INI

            // Misi
            $table->string('mission_title')->nullable();
            $table->text('mission_description')->nullable();
            $table->string('mission_image')->nullable();
            $table->string('mission_video')->nullable(); // TAMBAHKAN INI

            // Cerita Brand / Our Story
            $table->string('story_title')->nullable();
            $table->text('story_description')->nullable();
            $table->string('story_image')->nullable();
            $table->string('story_video')->nullable(); // TAMBAHKAN INI

            // Pencapaian & Sertifikasi
            $table->string('achievement_title')->nullable();
            $table->text('achievement_description')->nullable();
            $table->string('achievement_image')->nullable();
            $table->string('achievement_video')->nullable(); // TAMBAHKAN INI

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};
