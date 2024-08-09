<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Footballer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FootballersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Adicionando o futebolista 'traumtor'
        $footballer = new Footballer;
        $footballer->name = 'traumtor';
        $footballer->email = 'ti@traumtor.com.br';
        $footballer->document = '744.291.110-22';
        $footballer->phone = '(11) 97208-5251';
        $footballer->status = 'active';
        $footballer->password = bcrypt('PP2024!@#$%');
        $footballer->created_at = now();
        $footballer->updated_at = now();
        $footballer->save();

        $address = new Address;
        $address->footballer_id = $footballer->id;
        $address->zip_code = '01002-020';
        $address->street = 'Viaduto do Cha';
        $address->number = 15;
        $address->neighborhood = 'Downtown';
        $address->city = 'São Paulo';
        $address->state = 'SP';
        $address->created_at = now();
        $address->updated_at = now();
        $address->save();

        // Adicionando os outros futebolistas
        $footballers = [
            ['name' => 'Dvd', 'email' => 'dvd@example.com'],
            ['name' => 'Vz', 'email' => 'vz@example.com'],
            ['name' => 'Waldeco', 'email' => 'waldeco@example.com'],
            ['name' => 'Bozola', 'email' => 'bozola@example.com'],
            ['name' => 'Cebolinha', 'email' => 'cebolinha@example.com'],
            ['name' => 'James', 'email' => 'james@example.com'],
            ['name' => 'Wanderson', 'email' => 'wanderson@example.com'],
            ['name' => 'Esdras', 'email' => 'esdras@example.com'],
            ['name' => 'Joeliton', 'email' => 'joeliton@example.com'],
            ['name' => 'Davi', 'email' => 'davi@example.com'],
            ['name' => 'Diego', 'email' => 'diego@example.com'],
            ['name' => 'Ariel', 'email' => 'ariel@example.com'],
            ['name' => 'Dudu', 'email' => 'dudu@example.com'],
            ['name' => 'Erick', 'email' => 'erick@example.com'],
            ['name' => 'Razyel', 'email' => 'razyel@example.com'],
            ['name' => 'Luciano', 'email' => 'luciano@example.com'],
        ];

        foreach ($footballers as &$footballer) {
            $footballer['document'] = Str::random(10);
            $footballer['phone'] = '(11) ' . rand(90000, 99999) . '-' . rand(1000, 9999);
            $footballer['status'] = 'active';
            $footballer['overall'] = rand(50, 100);
            $footballer['height'] = rand(160, 200) / 100;
            $footballer['weight'] = rand(60, 100);
            $footballer['dominant_foot'] = ['right', 'left', 'ambidextrous'][array_rand(['right', 'left', 'ambidextrous'])];
            $footballer['email_verified_at'] = now();
            $footballer['password'] = bcrypt('qwe123!@#');
            $footballer['remember_token'] = Str::random(10);
            $footballer['created_at'] = now();
            $footballer['updated_at'] = now();
        }

        DB::table('footballers')->insert($footballers);

        $this->seedAddresses();
        $this->seedFootballerPositionAndModality();
    }

    private function seedAddresses()
    {
        $footballers = DB::table('footballers')->get();

        foreach ($footballers as $footballer) {
            DB::table('addresses')->insert([
                'footballer_id' => $footballer->id,
                'zip_code' => '01000-000',
                'street' => 'Rua ' . Str::random(10),
                'number' => rand(1, 1000),
                'neighborhood' => 'Bairro ' . Str::random(10),
                'complement' => 'Apto ' . rand(1, 100),
                'state' => 'SP',
                'city' => 'São Paulo',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    private function seedFootballerPositionAndModality()
    {
        $footballers = DB::table('footballers')->get();
        $positions = DB::table('positions')->get();

        foreach ($footballers as $footballer) {
            $assignedModalities = [];

            // Selecionar duas posições aleatórias
            $position1 = $positions->random();
            $position2 = $positions->random();

            // Garante que não haverá duplicidade na combinação footballer_id e position_id
            while (DB::table('footballer_position')->where('footballer_id', $footballer->id)->where('position_id', $position1->id)->exists()) {
                $position1 = $positions->random();
            }

            while ($position1->id == $position2->id || DB::table('footballer_position')->where('footballer_id', $footballer->id)->where('position_id', $position2->id)->exists()) {
                $position2 = $positions->random();
            }

            DB::table('footballer_position')->insert([
                'footballer_id' => $footballer->id,
                'position_id' => $position1->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('footballer_position')->insert([
                'footballer_id' => $footballer->id,
                'position_id' => $position2->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Adicionar a modalidade das posições à lista de modalidades do jogador
            $assignedModalities[] = $position1->modality_id;
            if ($position1->modality_id !== $position2->modality_id) {
                $assignedModalities[] = $position2->modality_id;
            }

            // Inserir modalidades únicas na tabela footballer_modality
            foreach (array_unique($assignedModalities) as $modalityId) {
                DB::table('footballer_modality')->insert([
                    'footballer_id' => $footballer->id,
                    'modality_id' => $modalityId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
