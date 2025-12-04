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
        Schema::table('about_us', function (Blueprint $table) {
            $table->string('intro_video')->nullable()->after('intro_image');
            $table->string('vision_video')->nullable()->after('vision_image');
            $table->string('mission_video')->nullable()->after('mission_image');
            $table->string('story_video')->nullable()->after('story_image');
            $table->string('achievement_video')->nullable()->after('achievement_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_us', function (Blueprint $table) {
            $table->dropColumn([
                'intro_video',
                'vision_video',
                'mission_video',
                'story_video',
                'achievement_video'
            ]);
        });
    }
};
