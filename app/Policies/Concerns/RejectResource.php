<?php

namespace App\Policies\Concerns;

use App\Models\User;

trait RejectResource
{
    /**
     * Determine whether the user can update the resource.
     *
     * @param User $user
     * @return mixed
     */
    public function reject(User $user, $model)
    {
        return $user->can('reject '. $this->resource);
    }
}
