<?php

namespace App\Http\ViewComposers\Admin;

use App\Repositories\UserRepository;
use Illuminate\View\View;
use App\Repositories\ExportRepository;

class ExportViewComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('users', (new UserRepository())->selectOptions());
        $view->with('models', (new ExportRepository())->modelOptions());
    }
}
