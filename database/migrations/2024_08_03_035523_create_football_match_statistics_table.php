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
        Schema::create('football_match_statistics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('football_match_id')
                  ->constrained('football_matches')
                  ->onDelete('cascade')
                  ->comment('Foreign key referencing football_matches table'); // Chave estrangeira para a partida
            $table->foreignId('footballer_id')
                  ->constrained('footballers')
                  ->onDelete('cascade')
                  ->comment('Foreign key referencing footballers table'); // Chave estrangeira para o futebolista
            $table->integer('goals')->default(0)->comment('Number of goals scored by the footballer'); // Número de gols
            $table->integer('fouls_committed')->default(0)->comment('Number of fouls committed by the footballer'); // Faltas cometidas
            $table->integer('tackles')->default(0)->comment('Number of tackles made by the footballer'); // Desarmes
            $table->integer('assists')->default(0)->comment('Number of assists made by the footballer'); // Assistências
            $table->integer('successful_dribbles')->default(0)->comment('Number of successful dribbles by the footballer'); // Dribles certos
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('football_match_statistics');
    }
};
