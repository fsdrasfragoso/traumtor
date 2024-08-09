<?php

namespace App\Policies;

use App\Policies\Concerns\ManageResource;
use Illuminate\Auth\Access\HandlesAuthorization;

class DashboardPolicy
{
    use HandlesAuthorization,
        ManageResource;

    protected $resource = 'dashboard';
}
