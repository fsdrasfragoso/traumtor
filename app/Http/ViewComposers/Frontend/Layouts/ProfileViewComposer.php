<?php

namespace App\Http\ViewComposers\Frontend\Layouts;

use App\Services\FootballerService;
use Illuminate\View\View;
use App\Models\Subscription;

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

        $subscribe_url = route('web.frontend.books.index');
        $subscribe_text_button = 'Acesse a vitrine';

        $view->with([
            'subscribe_url' => $subscribe_url,
            'subscribe_text_button' => $subscribe_text_button,
        ]);
    }
}
