<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('positions')->insert([
            // Setor de Defesa
            ['name' => 'Goleiro', 'description' => 'Jogador responsável por defender o gol.', 'modality_id' => 1], // Campo
            ['name' => 'Zagueiro', 'description' => 'Jogador responsável por defender a área central do campo.', 'modality_id' => 1], // Campo
            ['name' => 'Líbero', 'description' => 'Jogador com liberdade para organizar a defesa e iniciar ataques.', 'modality_id' => 1], // Campo
            ['name' => 'Lateral', 'description' => 'Jogador responsável por defender e atacar pelas laterais do campo.', 'modality_id' => 1], // Campo
        
            // Setor de Armação
            ['name' => 'Volante', 'description' => 'Jogador responsável por proteger a defesa e distribuir a bola.', 'modality_id' => 1], // Campo
            ['name' => 'Ala', 'description' => 'Jogador que atua pelas alas do campo, tanto na defesa quanto no ataque.', 'modality_id' => 1], // Campo
            ['name' => 'Meia de contenção', 'description' => 'Jogador responsável por bloquear os ataques adversários no meio campo.', 'modality_id' => 1], // Campo
            ['name' => 'Meia de armação', 'description' => 'Jogador responsável por criar jogadas ofensivas.', 'modality_id' => 1], // Campo
            ['name' => 'Meia extremado', 'description' => 'Jogador que atua nas extremidades do campo, próximo à linha lateral.', 'modality_id' => 1], // Campo
            ['name' => 'Meia atacante', 'description' => 'Jogador com foco em apoiar o ataque e criar oportunidades de gol.', 'modality_id' => 1], // Campo
        
            // Setor Ofensivo
            ['name' => 'Atacante recuado', 'description' => 'Jogador que atua mais recuado no ataque, ajudando na armação das jogadas.', 'modality_id' => 1], // Campo
            ['name' => 'Atacante de beirada', 'description' => 'Jogador que atua pelas beiradas do campo, buscando cortar para o meio e finalizar.', 'modality_id' => 1], // Campo
            ['name' => 'Atacante de área', 'description' => 'Jogador que atua dentro da área adversária, com foco em finalizar as jogadas.', 'modality_id' => 1], // Campo
        
            // Exemplo para Futsal (Salão)
            ['name' => 'Goleiro', 'description' => 'Jogador responsável por defender o gol.', 'modality_id' => 2], // Salão
            ['name' => 'Fixo', 'description' => 'Jogador fixo na defesa.', 'modality_id' => 2], // Salão
            ['name' => 'Ala', 'description' => 'Jogador que atua pelas alas do campo.', 'modality_id' => 2], // Salão
            ['name' => 'Pivô', 'description' => 'Jogador que atua no ataque, de costas para a defesa adversária.', 'modality_id' => 2], // Salão
            ['name' => 'Goleiro Linha', 'description' => 'Goleiro que também atua como jogador de linha.', 'modality_id' => 2], // Salão
        
            // Exemplo para Society
            ['name' => 'Goleiro', 'description' => 'Jogador responsável por defender o gol.', 'modality_id' => 3], // Society
            ['name' => 'Zagueiro', 'description' => 'Jogador responsável por defender a área central do campo.', 'modality_id' => 3], // Society
            ['name' => 'Lateral', 'description' => 'Jogador responsável por defender e atacar pelas laterais do campo.', 'modality_id' => 3], // Society
            ['name' => 'Meia', 'description' => 'Jogador responsável por armar jogadas e auxiliar na defesa.', 'modality_id' => 3], // Society
            ['name' => 'Atacante', 'description' => 'Jogador responsável por marcar gols.', 'modality_id' => 3], // Society
        ]);
    }
}
