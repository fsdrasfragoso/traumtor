<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Modality;

class ModalitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modalities = [
            ['name' => 'Campo', 'player_count' => 11],
            ['name' => 'Futsal', 'player_count' => 5],
            ['name' => 'Society', 'player_count' => 7],
        ];

        foreach ($modalities as $modality) 
        {
            Modality::create($modality);
        }
    }
}
