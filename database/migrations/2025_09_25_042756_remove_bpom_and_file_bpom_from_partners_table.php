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
        Schema::table('partners', function (Blueprint $table) {
            if (Schema::hasColumn('partners', 'bpom')) {
                $table->dropColumn('bpom');
            }
            if (Schema::hasColumn('partners', 'file_bpom')) {
                $table->dropForeign(['file_bpom']); // hapus foreign key dulu kalau ada
                $table->dropColumn('file_bpom');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('partners', function (Blueprint $table) {
            $table->boolean('bpom')->default(false);
            $table->unsignedBigInteger('file_bpom')->nullable();

            $table->foreign('file_bpom')->references('id')->on('file_partners')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }
};
