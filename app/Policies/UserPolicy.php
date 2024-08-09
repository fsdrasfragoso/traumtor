<?php

namespace App\Policies;

use App\Policies\Concerns\CreateResource;
use App\Policies\Concerns\DeleteResource;
use App\Policies\Concerns\ListResource;
use App\Policies\Concerns\ManageResource;
use App\Policies\Concerns\RestoreResource;
use App\Policies\Concerns\UpdateResource;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization,
        ManageResource,
        ListResource,
        CreateResource,
        UpdateResource,
        DeleteResource,
        RestoreResource;

    protected $resource = 'users';
}
