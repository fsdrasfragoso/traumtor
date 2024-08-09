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
        Schema::create('tactical_formations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Name of the tactical formation');
            $table->text('description')->nullable()->comment('Description of the tactical formation');
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
        Schema::dropIfExists('tactical_formations');
    }
};
