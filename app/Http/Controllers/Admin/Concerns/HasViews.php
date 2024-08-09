<?php

namespace App\Http\Controllers\Admin\Concerns;

use Illuminate\View\View;

trait HasViews
{
    /**
     * Default format for the views path. The following
     * replacements are made:
     *
     *  1. {action}: the current controller action;
     *  2. {table}: the resource table name
     *
     * @var string
     */
    protected $viewFormat = 'admin.{table}.{action}';

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
            [$action, $this->getTable()],
            $this->viewFormat
        );

        return view()->exists($name)
            ? view($name, $data)
            : view('admin.layouts.partials.crud.' . $action, $data);
    }
}
