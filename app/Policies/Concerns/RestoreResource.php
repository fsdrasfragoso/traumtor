<?php

namespace App\Policies\Concerns;

use App\Models\User;

trait RestoreResource
{
    /**
     * Determine whether the user can restore the resource.
     *
     * @param User $user
     * @param $model
     * @return mixed
     */
    public function restore(User $user, $model)
    {
        return $user->can('manage all') || $user->can('manage '. $this->resource) || $user->can('restore '. $this->resource);
    }
}
