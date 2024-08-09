<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Services\PermissionBatch;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createAndGrantPermission('manage gallery');
        
        $tables = DB::select('SHOW TABLES');
        $tableKey = 'Tables_in_' . env('DB_DATABASE');

        foreach ($tables as $table) {
            $tableName = $table->$tableKey;
            $this->createAndGrantPermissions($tableName);
        }
    }

    private function createAndGrantPermissions($tableName)
    {
        $permissions = [
            "manage $tableName",
            "list $tableName",
            "view $tableName",
            "export $tableName",
            "delete $tableName",
            "create $tableName",
            "change $tableName",
            "update $tableName",
            "restore $tableName",
            "approve $tableName",
            "reject $tableName",
            "audit $tableName",
            "rollback $tableName"
        ];

        foreach ($permissions as $permission) {
            $this->createAndGrantPermission($permission);
            dump("Create Permission {$permission}");
        }
    }

    private function createAndGrantPermission($permission)
    {
        (new PermissionBatch())
            ->pushAdminRole()
            ->pushPermission($permission)
            ->grant();
    }
}
