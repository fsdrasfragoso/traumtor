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
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->datetime('match_datetime');
            $table->string('local_name');        // Nome do local do jogo
            $table->string('address');           // Endereço do local
            $table->string('city');              // Cidade do local
            $table->string('state');             // Estado do local
            $table->string('zip_code');          // Código postal do local
            $table->foreignId('modality_id')->constrained('modalities')->onDelete('cascade'); // Chave estrangeira para modalidade
            $table->foreignId('scheduled_by')->constrained('footballers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};
