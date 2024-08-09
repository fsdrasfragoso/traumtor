<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::find(1);

        if(!$role) {
            try {
                $role = Role::create(['name' => 'Administrador (super)', 'guard_name' => 'users']);
            } catch (Exception $e) {
            }
        }

        $role->syncPermissions(Permission::where('guard_name', 'users')->get());
    }
}
