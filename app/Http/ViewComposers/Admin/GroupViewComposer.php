<?php

namespace App\Http\ViewComposers\Admin;

use App\Repositories\FootballerRepository;
use App\Repositories\ModalityRepository;
use App\Models\Group;
use Illuminate\View\View;

class GroupViewComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
                
        $daysOfWeek = [
            'sunday' => 'Domingo', 
            'monday' => 'Segunda-feira', 
            'tuesday' => 'Terça-feira', 
            'wednesday' => 'Quarta-feira', 
            'thursday' => 'Quinta-feira', 
            'friday' => 'Sexta-feira', 
            'saturday' => 'Sábado'
        ];
        
        $view->with('states',(new Group())->stateOptions());
        $view->with('daysOfWeek', $daysOfWeek);
        $view->with('footballers', (new FootballerRepository())->selectOptions());
        $view->with('modalities', (new ModalityRepository())->selectOptions());
    }
}
