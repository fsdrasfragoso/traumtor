<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (app()->environment() === 'production') {
            return;
        }

        app()['cache']->forget('spatie.permission.cache');

        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(FootballersTableSeeder::class);
        $this->call(ModalitiesTableSeeder::class);
        $this->call(PositionsTableSeeder::class);
        $this->call(TacticalFormationsTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
        
    }
}
