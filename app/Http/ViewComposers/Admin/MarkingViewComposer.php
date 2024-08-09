<?php

namespace App\Http\ViewComposers\Admin;

use App\Repositories\ModalityRepository;
use Illuminate\View\View;

class MarkingViewComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {       
        $view->with('modalities', (new ModalityRepository())->selectOptions()); 
    }
}
