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
        Schema::table('modalities', function (Blueprint $table) {
            $table->integer('player_count')->after('name')->default(0)->comment('Number of players in the modality');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('modalities', function (Blueprint $table) {
            $table->dropColumn('player_count');
        });
    }
};
