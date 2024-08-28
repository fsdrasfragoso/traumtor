<?php

namespace App\Http\Controllers\Frontend;

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


    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return View
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $footballer = footballer();

        $resources = $this->getRepository()
            ->index($request->all());

        return view('frontend.groups.index')
            ->with('type', $this->resourceType)
            ->with('footballer', $footballer)
            ->with('resources', $resources);
    }


    


    
}

