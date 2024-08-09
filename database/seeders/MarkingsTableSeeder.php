<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarkingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtendo os IDs das modalidades
        $modalityCampo = DB::table('modalities')->where('name', 'LIKE', '%Campo%')->where('player_count', 11)->first();
        $modalityFutsal = DB::table('modalities')->where('name', 'LIKE', '%Futsal%')->where('player_count', 5)->first();
        $modalitySociety = DB::table('modalities')->where('name', 'LIKE', '%Society%')->where('player_count', 7)->first();

        $markings = [
            // Campo
            [
                'name' => 'Marcação por Zona',
                'description' => 'Cada jogador é responsável por defender uma área específica da quadra, em vez de seguir um jogador adversário específico.',
                'advantages' => 'Mantém a estrutura defensiva organizada e facilita a cobertura dos espaços, impedindo penetrações.',
                'disadvantages' => 'Pode ser vulnerável contra jogadores adversários com boa habilidade individual que conseguem driblar a marcação.',
                'modality_id' => $modalityCampo->id,
            ],
            [
                'name' => 'Marcação Homem a Homem',
                'description' => 'Cada jogador marca um adversário específico, seguindo-o por toda a quadra.',
                'advantages' => 'Pode ser muito eficiente para desarmar jogadores habilidosos e sufocar a criação de jogadas.',
                'disadvantages' => 'Exige muita energia e atenção dos jogadores, além de poder criar buracos na defesa se algum jogador perder seu duelo individual.',
                'modality_id' => $modalityCampo->id,
            ],
            [
                'name' => 'Marcação Pressão',
                'description' => 'A equipe defensiva pressiona o adversário em toda a quadra, tentando roubar a bola rapidamente.',
                'advantages' => 'Pode forçar erros do adversário e criar oportunidades de contra-ataque.',
                'disadvantages' => 'Exige alta intensidade física e coordenação; se mal executada, pode deixar a defesa exposta.',
                'modality_id' => $modalityCampo->id,
            ],
            [
                'name' => 'Marcação Mista',
                'description' => 'Combina elementos de marcação por zona e homem a homem. Por exemplo, alguns jogadores podem estar marcando por zona, enquanto outros marcam individualmente os principais jogadores adversários.',
                'advantages' => 'Flexível e pode ser ajustada durante o jogo para se adaptar às mudanças táticas do adversário.',
                'disadvantages' => 'Pode ser confusa e exigir alto nível de comunicação e entendimento tático dos jogadores.',
                'modality_id' => $modalityCampo->id,
            ],

            // Futsal
            [
                'name' => 'Marcação em Meia Quadra',
                'description' => 'É uma marcação mais recuada, onde a equipe defensiva se posiciona na sua metade da quadra, esperando o adversário avançar.',
                'advantages' => 'Economiza energia dos jogadores e é eficaz contra equipes que têm dificuldade em penetrar defesas bem organizadas.',
                'disadvantages' => 'Dá mais espaço para o adversário trocar passes na sua quadra defensiva.',
                'modality_id' => $modalityFutsal->id,
            ],
            [
                'name' => 'Marcação por Zona',
                'description' => 'Cada jogador é responsável por defender uma área específica da quadra, em vez de seguir um jogador adversário específico.',
                'advantages' => 'Mantém a estrutura defensiva organizada e facilita a cobertura dos espaços, impedindo penetrações.',
                'disadvantages' => 'Pode ser vulnerável contra jogadores adversários com boa habilidade individual que conseguem driblar a marcação.',
                'modality_id' => $modalityFutsal->id,
            ],
            [
                'name' => 'Marcação Homem a Homem',
                'description' => 'Cada jogador marca um adversário específico, seguindo-o por toda a quadra.',
                'advantages' => 'Pode ser muito eficiente para desarmar jogadores habilidosos e sufocar a criação de jogadas.',
                'disadvantages' => 'Exige muita energia e atenção dos jogadores, além de poder criar buracos na defesa se algum jogador perder seu duelo individual.',
                'modality_id' => $modalityFutsal->id,
            ],
            [
                'name' => 'Marcação Pressão',
                'description' => 'A equipe defensiva pressiona o adversário em toda a quadra, tentando roubar a bola rapidamente.',
                'advantages' => 'Pode forçar erros do adversário e criar oportunidades de contra-ataque.',
                'disadvantages' => 'Exige alta intensidade física e coordenação; se mal executada, pode deixar a defesa exposta.',
                'modality_id' => $modalityFutsal->id,
            ],
            [
                'name' => 'Marcação Mista',
                'description' => 'Combina elementos de marcação por zona e homem a homem. Por exemplo, alguns jogadores podem estar marcando por zona, enquanto outros marcam individualmente os principais jogadores adversários.',
                'advantages' => 'Flexível e pode ser ajustada durante o jogo para se adaptar às mudanças táticas do adversário.',
                'disadvantages' => 'Pode ser confusa e exigir alto nível de comunicação e entendimento tático dos jogadores.',
                'modality_id' => $modalityFutsal->id,
            ],

            // Society
            [
                'name' => 'Marcação por Zona',
                'description' => 'Cada jogador é responsável por defender uma área específica da quadra, em vez de seguir um jogador adversário específico.',
                'advantages' => 'Mantém a estrutura defensiva organizada e facilita a cobertura dos espaços, impedindo penetrações.',
                'disadvantages' => 'Pode ser vulnerável contra jogadores adversários com boa habilidade individual que conseguem driblar a marcação.',
                'modality_id' => $modalitySociety->id,
            ],
            [
                'name' => 'Marcação Homem a Homem',
                'description' => 'Cada jogador marca um adversário específico, seguindo-o por toda a quadra.',
                'advantages' => 'Pode ser muito eficiente para desarmar jogadores habilidosos e sufocar a criação de jogadas.',
                'disadvantages' => 'Exige muita energia e atenção dos jogadores, além de poder criar buracos na defesa se algum jogador perder seu duelo individual.',
                'modality_id' => $modalitySociety->id,
            ],
            [
                'name' => 'Marcação Pressão',
                'description' => 'A equipe defensiva pressiona o adversário em toda a quadra, tentando roubar a bola rapidamente.',
                'advantages' => 'Pode forçar erros do adversário e criar oportunidades de contra-ataque.',
                'disadvantages' => 'Exige alta intensidade física e coordenação; se mal executada, pode deixar a defesa exposta.',
                'modality_id' => $modalitySociety->id,
            ],
            [
                'name' => 'Marcação Mista',
                'description' => 'Combina elementos de marcação por zona e homem a homem. Por exemplo, alguns jogadores podem estar marcando por zona, enquanto outros marcam individualmente os principais jogadores adversários.',
                'advantages' => 'Flexível e pode ser ajustada durante o jogo para se adaptar às mudanças táticas do adversário.',
                'disadvantages' => 'Pode ser confusa e exigir alto nível de comunicação e entendimento tático dos jogadores.',
                'modality_id' => $modalitySociety->id,
            ],
        ];

        DB::table('markings')->insert($markings);
    }
}
