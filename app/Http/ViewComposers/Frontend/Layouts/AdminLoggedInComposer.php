<?php

namespace App\Http\ViewComposers\Frontend\Layouts;

use App\Services\ContentService;
use Illuminate\View\View;

class AdminLoggedInComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $edit_link = null;
        $edit_title = '';

        if (user()) {
            $route = \Request::route()->getName();

            switch ($route) {
                case (strpos($route, 'web.checkout.subscriptions.') !== false):
                    $edit_link = $view->plan ? route('web.admin.plans.edit', $view->plan->id) : null;
                    $edit_title = 'Plano';
                    break;


                case (strpos($route, 'web.checkout.book_purchases.') !== false):
                    $edit_link = $view->book ? route('web.admin.books.edit', $view->book->id) : null;
                    $edit_title = 'Livro';
                    break;
            }
        }

        $view->with(compact('edit_link', 'edit_title'));
    }
}
