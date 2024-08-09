<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Footballer;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Repositories\FootballerRepository;
use App\Http\Requests\Admin\SaveFootballerRequest;
use App\Repositories\FootballerActivityRepository;
use App\Http\Controllers\Admin\Concerns\ExportData;


class FootballerController extends CrudController
{
    use ExportData;

    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = Footballer::class;

    /**
     * Type of the managing repository.
     *
     * @var string
     */
    protected $repositoryType = FootballerRepository::class;

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function change(Request $request, $id)
    {
        $instance = $this->getRepository()
            ->find($id, true);

        $this->authorize('change', $instance);

        if ($resource = $this->getRepository()
            ->update($instance, $this->formParams())
        ) {
            return $this->afterUpdate($resource);
        }

        return $this->afterFailed('updated');
    }

    /**
     *
     * @param $id
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function login($id)
    {
        /** @var Footballer $footballer */
        $footballer = $this->getRepository()->find($id);

        $this->authorize('manage', $footballer);

        auth('footballers')->login($footballer);

        activity()
            ->performedOn($footballer)
            ->log('login_by_admin');

        return redirect()->route('web.frontend.default.index');
    }

    /**
     * Add activity.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function activity(Request $request, $id)
    {
        $footballer = $this->getRepository()->find($id);

        $this->authorize('manage', $footballer);

        $activity = (new FootballerActivityRepository())->create($request->input());

        return redirect()->route('web.admin.footballer_activities.show', $activity)
            ->with('success', __('Atividade criada com sucesso.'));
    }

    /**
     * Returns the request that should be used to validate.
     *
     * @return SaveFootballerRequest
     */
    protected function formRequest()
    {
        return app(SaveFootballerRequest::class);
    }
}
