<?php

namespace App\Policies\Concerns;

use App\Models\User;

trait CreateResource
{
    /**
     * Determine whether the user can create the resource.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('manage all') || $user->can('manage '. $this->resource) || $user->can('create '. $this->resource);
    }
}
