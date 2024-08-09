<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\SaveRoleRequest;
use App\Models\Role;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;

class RoleController extends CrudController
{
    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = Role::class;

    /**
     * Type of the managing repository.
     *
     * @var string
     */
    protected $repositoryType = RoleRepository::class;

    /**
     * Returns the request that should be used to validate.
     *
     * @return Request
     */
    protected function formRequest()
    {
        return app(SaveRoleRequest::class);
    }
}
