<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AlbumPolicy
{
    use HandlesAuthorization;

    protected $resource = 'albums';

    /**
     * Determine whether the user can manage the gallery.
     *
     * @param User $user
     * @return mixed
     */
    public function gallery(User $user)
    {
        return $user->can('manage all') || $user->can('manage gallery');
    }

}
