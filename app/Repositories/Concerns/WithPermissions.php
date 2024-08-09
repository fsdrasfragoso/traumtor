<?php

namespace App\Repositories\Concerns;

use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Permission;

trait WithPermissions
{
    /**
     * Overrides publishing fields data.
     *
     * @param HasRoles|HasPermissions
     */
    protected function syncPermissions($resource, $key = 'permissions')
    {
        $resource->syncPermissions(collect(request()->input($key, []))->map(fn($val)=>(int)$val));
    }
}
