<?php

namespace App\Http\ViewComposers\Admin;

use App\Repositories\PositionRepository;
use App\Repositories\ModalityRepository;

use Illuminate\View\View;

class FootballerViewComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('type_group',\App\Models\Footballer::class);
        $view->with('positions', (new PositionRepository())->selectOptions());
        $view->with('modalities', (new ModalityRepository())->selectOptions()); 
    }
}
