<?php

namespace App\Http\ViewComposers\Admin;

use App\Repositories\PermissionRepository;
use Illuminate\View\View;

class RoleViewComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('permissions', (new PermissionRepository())->permissionsForUsers());
    }
}
