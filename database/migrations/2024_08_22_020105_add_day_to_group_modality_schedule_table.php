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
        Schema::table('group_modality_schedule', function (Blueprint $table) {
            $table->enum('day', [
                'domingo', 
                'segunda-feira', 
                'terça-feira', 
                'quarta-feira', 
                'quinta-feira', 
                'sexta-feira', 
                'sábado'
            ])->after('modality_id')->comment('Day of the week');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('group_modality_schedule', function (Blueprint $table) {
            $table->dropColumn('day');
        });
    }
};
