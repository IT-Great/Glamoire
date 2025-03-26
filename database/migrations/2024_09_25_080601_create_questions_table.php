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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('email');
            $table->text('question');
            $table->text('response')->nullable();
            $table->string('response_image')->nullable(); // Untuk menyimpan path gambar
            $table->string('response_video')->nullable(); // Untuk menyimpan path video
            $table->enum('status', ['unread', 'read'])->default('unread');
            $table->timestamp('responded_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
