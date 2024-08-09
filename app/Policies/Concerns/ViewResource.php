<?php

namespace App\Policies\Concerns;

use App\Models\User;

trait ViewResource
{
    /**
     * Determine whether the user can view the resources.
     *
     * @param User $user
     * @param $model
     * @return mixed
     */
    public function view(User $user, $model)
    {
        return $user->can('manage all') || $user->can('manage '. $this->resource) || $user->can('view '. $this->resource);
    }
}
