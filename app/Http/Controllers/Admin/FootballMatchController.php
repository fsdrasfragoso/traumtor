<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\SaveFootballMatchRequest;
use App\Models\FootballMatch;
use App\Repositories\FootballMatchRepository;
use Illuminate\Http\Request;

class FootballMatchController extends CrudController
{
    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = FootballMatch::class;

    /**
     * Type of the managing repository.
     *
     * @var string
     */
    protected $repositoryType = FootballMatchRepository::class;

    /**
     * Returns the request that should be used to validate.
     *
     * @return Request
     */
    protected function formRequest()
    {
        return app(SaveFootballMatchRequest::class);
    }


     /**
     * Where to redirect after creating the resource.
     *
     * @param Model $resource
     *
     * @return RedirectResponse
     */
    protected function afterCreate(Request $request, $resource)
    {      

        $route = back();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => modelAction($this->resourceType, 'success.created')
            ]);
        }

        return $route->with('success', modelAction($this->resourceType, 'success.created'));
    }

    
}

