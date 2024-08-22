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
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('schedules')->comment('Field for court schedules');
            $table->string('street');
            $table->string('number');
            $table->string('zip_code');
            $table->string('neighborhood');
            $table->string('city');
            $table->string('state');
            $table->foreignId('modality_id')
                ->constrained('modalities')
                ->onDelete('cascade')
                ->comment('Foreign key referencing modalities table');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
