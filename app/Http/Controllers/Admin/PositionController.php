<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\SavePositionRequest;
use App\Models\Position;
use App\Repositories\PositionRepository;
use Illuminate\Http\Request;

class PositionController extends CrudController
{
    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = Position::class;

    /**
     * Type of the managing repository.
     *
     * @var string
     */
    protected $repositoryType = PositionRepository::class;

    /**
     * Returns the request that should be used to validate.
     *
     * @return Request
     */
    protected function formRequest()
    {
        return app(SavePositionRequest::class);
    }

    


}
