<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\SaveGroupRequest;
use App\Models\Group;
use App\Repositories\GroupRepository;
use Illuminate\Http\Request;

class GroupController extends CrudController
{
    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = Group::class;

    /**
     * Type of the managing repository.
     *
     * @var string
     */
    protected $repositoryType = GroupRepository::class;

    /**
     * Returns the request that should be used to validate.
     *
     * @return Request
     */
    protected function formRequest()
    {
        return app(SaveGroupRequest::class);
    }

    
}

