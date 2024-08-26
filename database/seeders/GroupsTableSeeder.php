<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Group;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Dados a serem inseridos na tabela groups
        $groups = [
            [
                'name' => 'FUTSAL SEGUNDA DAS 21 ÀS 22:30?',
                'street' => 'Rua Ribeiro de Morais',
                'number' => 380,
                'zip_code' => '02731-030',
                'neighborhood' => 'Vila Albertina',
                'city' => 'São Paulo',
                'state' => 'SP',
                'captain_id' => 9, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Dados para popular a tabela group_modality_schedule
        $schedules = [
            [
                'day' => 'monday',
                'start_time' => '21:00:00',
                'closing_time' => '23:00:00',
                'modality_id' => 2,
            ],
            [
                'day' => 'sunday',
                'start_time' => '10:00:00',
                'closing_time' => '12:00:00',
                'modality_id' => 2,
            ],
        ];

        $footballerIds = [
            13, 5, 6, 11, 12, 14, 2, 15, 9, 7, 10, 17, 16, 3, 4, 8
        ];

        foreach ($groups as $groupData) {
            // Cria o grupo
            $group = Group::create($groupData);
            dump("Create Group {$group->name}");
            $group->footballers()->sync($footballerIds);
            dump("footballers in Group");
            foreach ($schedules as $schedule) {
                $group->schedules()->create([
                    'day' => $schedule['day'],
                    'start_time' => $schedule['start_time'],
                    'closing_time' => $schedule['closing_time'],
                    'modality_id' => $schedule['modality_id'],
                ]);
                dump("schedules in Group");
            }
        }
    }
}
