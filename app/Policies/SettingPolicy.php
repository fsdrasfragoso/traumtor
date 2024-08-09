<?php

namespace App\Policies;

use App\Models\User;
use App\Policies\Concerns\ManageResource;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettingPolicy
{
    use HandlesAuthorization,
        ManageResource;

    protected $resource = 'settings';

    /**
     * Determine whether the user can update features settings.
     *
     * @param User $user
     * @return mixed
     */
    public function features(User $user)
    {
        return $user->can('manage all')
            || $user->can('manage ' . $this->resource)
            || $user->can('update features ' . $this->resource);
    }

    /**
     * Determine whether the user can update books settings.
     *
     * @param User $user
     * @return mixed
     */
    public function books(User $user)
    {
        return $user->can('manage all')
            || $user->can('manage ' . $this->resource)
            || $user->can('update books ' . $this->resource);
    }

    public function emails(User $user)
    {
        return $user->can('manage all')
            || $user->can('manage ' . $this->resource)
            || $user->can('update emails ' . $this->resource);
    }

    /**
     * Determine whether the user can update emails blocks.
     *
     * @param User $user
     * @return mixed
     */
    public function blocks(User $user)
    {
        return $user->can('manage all')
            || $user->can('manage ' . $this->resource)
            || $user->can('update blocks ' . $this->resource);
    }
}
