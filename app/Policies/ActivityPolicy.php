<?php

namespace App\Policies;

use App\Policies\Concerns\ExportResource;
use App\Policies\Concerns\ListResource;
use App\Policies\Concerns\ManageResource;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActivityPolicy
{
    use HandlesAuthorization,
        ManageResource,
        ListResource,
        ExportResource;

    protected $resource = 'activities';
}
