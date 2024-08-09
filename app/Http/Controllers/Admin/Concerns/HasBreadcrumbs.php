<?php

namespace App\Http\Controllers\Admin\Concerns;

use App\Libraries\Database\Eloquent\Model;

trait HasBreadcrumbs
{
    /**
     * Add a new crumb to the breadcrumbs.
     *
     * @param Model $resource
     * @param string $action
     * @param array $parameters
     * @return void
     */
    protected function addBreadcrumb($resource, $action, $parameters = [])
    {
        if (!method_exists($resource, 'trans')) {
            return;
        }

        app('breadcrumbs')
            ->addNewCrumb(
                $resource->trans($action),
                $resource->route($action, $parameters)
            );
    }
}
