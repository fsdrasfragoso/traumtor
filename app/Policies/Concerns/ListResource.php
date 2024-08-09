<?php

namespace App\Policies\Concerns;

use App\Models\User;

trait ListResource
{
    /**
     * Determine whether the user can list the resources.
     *
     * @param User $user
     * @return mixed
     */
    public function list(User $user)
    {
        
        return $user->can('manage all') || $user->can('manage '. $this->resource) || $user->can('list '. $this->resource);
    }
}
