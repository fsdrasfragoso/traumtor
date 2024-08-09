<?php

namespace App\Services;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionBatch
{
    private $roles;
    private $permissions;

    public function __construct()
    {
        $this->roles = collect();
        $this->permissions = collect();
    }

    /**
     * Push role.
     *
     * @param Role|null $role
     */
    public function pushRole($role)
    {
        if ($role) {
            $this->roles[] = $role;
        }

        return $this;
    }

    public function pushPermission(string $permission)
    {
        $this->permissions[] = $permission;
        return $this;
    }

    public function pushAdminRole()
    {
        $adminRoleId = 1;
        return $this->pushRole(Role::find($adminRoleId));
    }

    public function grant()
    {
        $permissions = $this->permissions;
        $this->roles->each(function ($role) use ($permissions) {
            $permissions->each(function ($name) use ($role) {
                $permission = Permission::firstOrCreate([
                    'name' => $name, 'guard_name' => $role->guard_name,
                ]);
                $role->givePermissionTo($permission);
            });
        });
    }

    public function revoke()
    {
        $permissions = $this->permissions;
        $this->roles->each(function ($role) use ($permissions) {
            $permissions->each(function ($name) use ($role) {
                $role->revokePermissionTo($name);
            });
        });
    }

    public function revokeAndDelete()
    {
        $permissions = $this->permissions;
        $this->roles->each(function ($role) use ($permissions) {
            $permissions->each(function ($name) use ($role) {
                Permission::where([
                    'name' => $name, 'guard_name' => $role->guard_name,
                ])->delete();
            });
        });
    }
}
