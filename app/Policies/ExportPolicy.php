<?php

namespace App\Policies;

use App\Policies\Concerns\ListResource;
use App\Policies\Concerns\ManageResource;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExportPolicy
{
    use HandlesAuthorization,
        ManageResource,
        ListResource;

    protected $resource = 'exports';
}
