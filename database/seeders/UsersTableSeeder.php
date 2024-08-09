<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::query()->first();

        $admin = new User;
        $admin->name = 'traumtor';
        $admin->email = 'ti@traumtor.com.br';
        $admin->password = bcrypt('qwe123!@#');
        $admin->save();

        $admin->assignRole($adminRole);
    }
}
