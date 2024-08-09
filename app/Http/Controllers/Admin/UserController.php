<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\SaveUserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends CrudController
{
    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = User::class;

    /**
     * Type of the managing repository.
     *
     * @var string
     */
    protected $repositoryType = UserRepository::class;

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request)
    {
        $this->authorize('create', $this->resourceType);

        if ($resource = (new UserService())->register($this->formParams())) {
            return $this->afterCreate($resource);
        }

        return $this->afterFailed('created');
    }

    /**
     * Returns the request that should be used to validate.
     *
     * @return Request
     */
    protected function formRequest()
    {
        return app(SaveUserRequest::class);
    }
}
