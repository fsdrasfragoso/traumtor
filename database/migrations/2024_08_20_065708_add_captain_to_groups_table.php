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
        Schema::table('groups', function (Blueprint $table) {
            $table->foreignId('captain_id')
                  ->nullable()
                  ->constrained('footballers')
                  ->onDelete('set null')
                  ->comment('Foreign key referencing footballers table, defines the captain of the group');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->dropForeign(['captain_id']);
            $table->dropColumn('captain_id');
        });
    }
};
