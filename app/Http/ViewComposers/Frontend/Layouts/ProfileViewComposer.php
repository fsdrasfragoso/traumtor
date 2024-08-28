<?php

namespace App\Http\ViewComposers\Frontend\Layouts;

use App\Services\FootballerService;
use Illuminate\View\View;
use App\Models\Subscription;
use App\Repositories\PositionRepository;
use App\Repositories\ModalityRepository;


class ProfileViewComposer
{
    /**
     * Bind data to the view.
     *
     * @return void
     */
    public function compose(View $view)
    {
        $footballer = footballer();

        $subscribe_url = '#';
        $subscribe_text_button = 'Acesse a vitrine';


        $view->with('type_group',\App\Models\Footballer::class);
        $view->with('positions', (new PositionRepository())->selectOptions());
        $view->with('modalities', (new ModalityRepository())->selectOptions()); 

        $view->with([
            'subscribe_url' => $subscribe_url,
            'subscribe_text_button' => $subscribe_text_button,
        ]);
    }
}
