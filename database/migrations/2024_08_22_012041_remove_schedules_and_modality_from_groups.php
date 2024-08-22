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
            // Remove o campo schedules
            $table->dropColumn('schedules');

            // Remove a foreign key e o campo modality_id
            $table->dropForeign(['modality_id']);
            $table->dropColumn('modality_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('groups', function (Blueprint $table) {
            // Recria o campo schedules
            $table->json('schedules')->comment('Field for court schedules');

            // Recria o campo modality_id e a chave estrangeira
            $table->foreignId('modality_id')
                ->constrained('modalities')
                ->onDelete('cascade')
                ->comment('Foreign key referencing modalities table');
        });
    }
};
