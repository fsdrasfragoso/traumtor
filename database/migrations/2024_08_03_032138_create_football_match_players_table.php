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
        Schema::create('football_match_players', function (Blueprint $table) {
            $table->id();
            $table->foreignId('football_match_id')
                  ->constrained('football_matches')
                  ->onDelete('cascade')
                  ->comment('Foreign key referencing football_matches table'); // Chave estrangeira para a partida
            $table->foreignId('footballer_id')
                  ->constrained('footballers')
                  ->onDelete('cascade')
                  ->comment('Foreign key referencing footballers table'); // Chave estrangeira para o futebolista
            $table->boolean('is_present')
                  ->default(false)
                  ->comment('Indicates if the footballer confirmed their presence'); // Coluna para confirmar a presença
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('football_match_players');
    }
};
