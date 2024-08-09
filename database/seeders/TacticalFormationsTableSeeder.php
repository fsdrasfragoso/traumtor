<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TacticalFormationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $formations = [
            // Futebol
            ['name' => '4-4-2', 'description' => 'Formação com quatro defensores, quatro meio-campistas e dois atacantes.', 'modality_id' => 1],
            ['name' => '4-3-3', 'description' => 'Formação com quatro defensores, três meio-campistas e três atacantes.', 'modality_id' => 1],
            ['name' => '3-5-2', 'description' => 'Formação com três defensores, cinco meio-campistas e dois atacantes.', 'modality_id' => 1],
            ['name' => '4-2-3-1', 'description' => 'Formação com quatro defensores, dois meio-campistas defensivos, três meio-campistas ofensivos e um atacante.', 'modality_id' => 1],
            ['name' => '4-1-4-1', 'description' => 'Formação com quatro defensores, um meio-campista defensivo, quatro meio-campistas ofensivos e um atacante.', 'modality_id' => 1],

            // Futsal
            ['name' => '3-1', 'description' => 'Formação com três jogadores de linha na defesa e um jogador avançado.', 'modality_id' => 2],
            ['name' => '2-2', 'description' => 'Formação com dois jogadores na defesa e dois no ataque.', 'modality_id' => 2],
            ['name' => '4-0', 'description' => 'Formação com quatro jogadores de linha na defesa, sem jogadores fixos no ataque.', 'modality_id' => 2],
            ['name' => '1-2-1', 'description' => 'Formação com um jogador na defesa, dois no meio e um no ataque.', 'modality_id' => 2],

            // Society
            ['name' => '2-3-1', 'description' => 'Formação com dois defensores, três meio-campistas e um atacante.', 'modality_id' => 3],
            ['name' => '3-2-1', 'description' => 'Formação com três defensores, dois meio-campistas e um atacante.', 'modality_id' => 3],
            ['name' => '2-2-2', 'description' => 'Formação com dois defensores, dois meio-campistas e dois atacantes.', 'modality_id' => 3],
        ];

        DB::table('tactical_formations')->insert($formations);
    }
}
