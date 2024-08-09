<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\SaveTacticalFormationRequest;
use App\Models\TacticalFormation;
use App\Repositories\TacticalFormationRepository;
use Illuminate\Http\Request;

class TacticalFormationController extends CrudController
{
    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = TacticalFormation::class;

    /**
     * Type of the managing repository.
     *
     * @var string
     */
    protected $repositoryType = TacticalFormationRepository::class;

    /**
     * Returns the request that should be used to validate.
     *
     * @return Request
     */
    protected function formRequest()
    {
        return app(SaveTacticalFormationRequest::class);
    }

    


}
