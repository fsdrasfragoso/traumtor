<?php

namespace App\Repositories;

use App\Repositories\Concerns\WithPermissions;
use App\Models\Role;
use App\Repositories\Concerns\WithSelectOptions;
use Illuminate\Support\Collection;

class RoleRepository extends CrudRepository
{
    use WithPermissions,
        WithSelectOptions;

    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = Role::class;

    /**
     * Return the resource main column.
     *
     * @return string
     */
    public function getResourceLabel()
    {
        return 'name';
    }

    /**
     * Gets roles available for users.
     *
     * @return Collection|Role[]
     */
    public function rolesForUsers()
    {
        return $this->newQuery()
            ->where('guard_name', 'users')
            ->orderBy('created_at')
            ->get();
    }

    /**
     * Filter attributes.
     *
     * @param array $attributes
     * @return array
     */
    public function filterAttributes($attributes)
    {
        $attributes['guard_name'] = 'users';

        return $attributes;
    }

    /**
     * Handles model after save.
     *
     * @param Role $resource
     * @param array $attributes
     * @return Role
     */
    public function afterSave($resource, $attributes)
    {
        $this->syncPermissions($resource);

        return $resource;
    }
}
