<?php

namespace App\Policies;

use App\Policies\Concerns\ListResource;
use App\Policies\Concerns\ManageResource;
use Illuminate\Auth\Access\HandlesAuthorization;

class WebhookPolicy
{
    use HandlesAuthorization,
        ManageResource,
        ListResource;

    protected $resource = 'webhooks';
}
