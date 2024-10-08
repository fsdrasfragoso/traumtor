<?php

namespace App\Http\Controllers\Frontend;

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

        return view('frontend.football_matches.index')
            ->with('type', $this->resourceType)
            ->with('footballer', $footballer)
            ->with('resources', $resources);
    }

    
}

