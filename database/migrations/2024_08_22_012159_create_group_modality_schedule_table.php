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
        Schema::create('group_modality_schedule', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')
                ->constrained('groups')
                ->onDelete('cascade')
                ->comment('Foreign key referencing groups table');
            $table->foreignId('modality_id')
                ->constrained('modalities')
                ->onDelete('cascade')
                ->comment('Foreign key referencing modalities table');
            $table->time('start_time')->comment('Start time of the schedule');
            $table->time('closing_time')->comment('Closing time of the schedule');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_modality_schedule');
    }
};
