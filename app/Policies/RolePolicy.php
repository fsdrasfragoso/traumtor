<?php

namespace App\Policies;

use App\Policies\Concerns\CreateResource;
use App\Policies\Concerns\DeleteResource;
use App\Policies\Concerns\ListResource;
use App\Policies\Concerns\ManageResource;
use App\Policies\Concerns\UpdateResource;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization,
        ManageResource,
        ListResource,
        CreateResource,
        UpdateResource,
        DeleteResource;

    protected $resource = 'roles';
}
