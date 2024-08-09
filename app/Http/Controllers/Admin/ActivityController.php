<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\ExportData;
use App\Models\Activity;
use App\Repositories\ActivityRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ActivityController extends CrudController
{
    use ExportData;

    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = Activity::class;

    /**
     * Type of the managing repository.
     *
     * @var string
     */
    protected $repositoryType = ActivityRepository::class;

    /**
     * Get view by action.
     *
     * @param string $action
     * @param array $data
     * @return View
     */
    public function view($action, $data = [])
    {
        $name = str_replace(
            ['{action}', '{table}'],
            [$action, 'activities'],
            $this->viewFormat
        );

        return view()->exists($name)
            ? view($name, $data)
            : view('admin.layouts.partials.crud.'.$action, $data);
    }
}
