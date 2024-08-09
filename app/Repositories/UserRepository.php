<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Concerns\WithSelectOptions;

class UserRepository extends CrudRepository
{
    use WithSelectOptions;

    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = User::class;

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
     * Apply filters.
     *
     * @param Builder $query
     * @param array $params
     * @return Builder
     */
    public function applyFilter($query, $params)
    {
        return $query->select('users.*')
            ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->groupBy('users.id');
    }

    /**
     * Filter attributes.
     *
     * @param array $attributes
     * @return array
     */
    public function filterAttributes($attributes)
    {
        if (is_null(data_get($attributes, 'password'))) {
            unset($attributes['password']);
        } else {
            $attributes['password'] = bcrypt($attributes['password']);
        }

        return $attributes;
    }

    /**
     * Handles model after save.
     *
     * @param User $resource
     * @param array $attributes
     * @return User
     */
    public function afterSave($resource, $attributes)
    {
        $resource->syncRoles(data_get($attributes, 'roles', []));

        return $resource;
    }
}
