<?php

namespace App\Policies\Concerns;

use App\Models\User;

trait UpdateResource
{
    /**
     * Determine whether the user can update the resource.
     *
     * @param User $user
     * @return mixed
     */
    public function update(User $user, $model)
    {
        return $user->can('manage all') || $user->can('manage '. $this->resource) || $user->can('update '. $this->resource);
    }
}
