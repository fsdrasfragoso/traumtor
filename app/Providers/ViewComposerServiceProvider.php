<?php

namespace App\Providers;

use App\Http\ViewComposers\Admin as Admin;
use App\Http\ViewComposers\Checkout as Checkout;
use App\Http\ViewComposers\Frontend as Frontend;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // 
        
        View::composer('admin.exports.*', Admin\ExportViewComposer::class);
        View::composer('admin.roles.*', Admin\RoleViewComposer::class);
        View::composer('admin.users.*', Admin\UserViewComposer::class);
        View::composer('admin.footballers.*', Admin\FootballerViewComposer::class);
        View::composer('admin.groups.*', Admin\GroupViewComposer::class);
        View::composer('frontend.*', Frontend\Layouts\ProfileViewComposer::class);
        View::composer('admin.positions.*', Admin\PositionViewComposer::class);
        View::composer('admin.markings.*', Admin\MarkingViewComposer::class); 
        View::composer('admin.tactical_formations.*', Admin\TacticalFormationViewComposer::class);
        View::composer('frontend.layouts.components.admin_logged_in_bar', Frontend\Layouts\AdminLoggedInComposer::class);

       
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }
}
