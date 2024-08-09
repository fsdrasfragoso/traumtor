<?php

namespace App\Policies\Concerns;

use App\Models\User;

trait ChangeResource
{
    /**
     * Determine whether the user can change the resources.
     *
     * @param User $user
     * @param $model
     * @return mixed
     */
    public function change(User $user, $model)
    {
        return $user->can('manage all') || $user->can('manage '. $this->resource) || $user->can('change '. $this->resource);
    }
}
