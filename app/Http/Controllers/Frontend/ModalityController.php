<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\Admin\SaveModalityRequest;
use App\Models\Modality;
use App\Repositories\ModalityRepository;
use Illuminate\Http\Request;

class ModalityController extends CrudController
{
    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = Modality::class;

    /**
     * Type of the managing repository.
     *
     * @var string
     */
    protected $repositoryType = ModalityRepository::class;

    /**
     * Returns the request that should be used to validate.
     *
     * @return Request
     */
    protected function formRequest()
    {
        return app(SaveModalityRequest::class);
    }

    


}
