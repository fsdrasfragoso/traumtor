<?php

namespace App\Policies\Concerns;

use App\Models\User;

trait DeleteResource
{
    /**
     * Determine whether the user can delete the resource.
     *
     * @param User $user
     * @param $model
     * @return mixed
     */
    public function delete(User $user, $model)
    {
        return $user->can('manage all') || $user->can('manage '. $this->resource) || $user->can('delete '. $this->resource);
    }
}
