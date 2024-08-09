<?php

namespace App\Policies\Concerns;

use App\Models\User;

trait ApproveResource
{
    /**
     * Determine whether the user can update the resource.
     *
     * @param User $user
     * @return mixed
     */
    public function approve(User $user, $model)
    {
        return $user->can('approve '. $this->resource);
    }
}
