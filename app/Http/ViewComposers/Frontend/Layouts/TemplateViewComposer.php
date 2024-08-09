<?php

namespace App\Http\ViewComposers\Frontend\Layouts;

use App\Services\FootballerService;
use Illuminate\View\View;

class TemplateViewComposer
{
    /**
     * Bind data to the view.
     *
     * @return void
     */
    public function compose(View $view)
    {
        $footballer = footballer();
        $paymentProfile = $footballer ? $footballer->paymentProfiles->first() : null;

        $routeName = request()->route()->getName();

        $view->with([
            'footballer' => $footballer,
            'paymentProfile' => $paymentProfile,
            'routeName' => $routeName,
        ]);
    }
}
