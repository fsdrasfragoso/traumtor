<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\SaveMarkingRequest;
use App\Models\Marking;
use App\Repositories\MarkingRepository;
use Illuminate\Http\Request;

class MarkingController extends CrudController
{
    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = Marking::class;

    /**
     * Type of the managing repository.
     *
     * @var string
     */
    protected $repositoryType = MarkingRepository::class;

    /**
     * Returns the request that should be used to validate.
     *
     * @return Request
     */
    protected function formRequest()
    {
        return app(SaveMarkingRequest::class);
    }

    


}
