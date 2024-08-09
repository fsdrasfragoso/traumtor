<?php

namespace App\Policies\Concerns;

use App\Models\User;

trait ExportResource
{
    /**
     * Determine whether the user can export the resource.
     *
     * @param User $user
     * @return mixed
     */
    public function export(User $user)
    {
        return $user->can('manage all') || $user->can('manage '. $this->resource) || $user->can('export '. $this->resource);
    }
}
