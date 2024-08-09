<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Spatie\Permission\Models\Permission;

class PermissionRepository
{
    /**
     * Gets permissions available for users
     *
     * @return Collection|Permission[]
     */
    public function permissionsForUsers()
    {
        return Permission::query()
            ->where('guard_name', 'users')
            ->orderBy('created_at')
            ->get();
    }

    /**
     * Gets permissions available for clients
     *
     * @return Collection|Permission[]
     */
    public function permissionsForClients()
    {
        return Permission::query()
            ->where('guard_name', 'clients')
            ->orderBy('created_at')
            ->get();
    }
}
