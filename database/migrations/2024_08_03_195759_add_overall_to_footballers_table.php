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
        Schema::table('footballers', function (Blueprint $table) {
            $table->unsignedTinyInteger('overall')
                  ->after('status')
                  ->default(50)
                  ->comment('Overall rating of the footballer, from 1 to 99');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('footballers', function (Blueprint $table) {
            $table->dropColumn('overall');
        });
    }
};
