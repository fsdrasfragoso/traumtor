<?php

namespace App\Policies\Concerns;

use App\Models\User;

trait RollbackResource
{
    /**
     * Determine whether the user can update the resource.
     *
     * @param User $user
     * @return mixed
     */
    public function rollback(User $user, $model)
    {
        return $user->can('rollback '. $this->resource);
    }
}

