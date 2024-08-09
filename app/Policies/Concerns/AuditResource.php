<?php

namespace App\Policies\Concerns;

use App\Models\User;

trait AuditResource
{
    /**
     * Determine whether the user can update the resource.
     *
     * @param User $user
     * @return mixed
     */
    public function audit(User $user, $model)
    {
        return $user->can('audit '. $this->resource);
    }
}
