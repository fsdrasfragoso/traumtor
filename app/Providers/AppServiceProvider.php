<?php

namespace App\Providers;

use App\Libraries\Breadcrumbs\Breadcrumbs;
use App\Libraries\Html\Html;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale(config('app.locale'));

        if (isset($_SERVER['HTTPS']) || in_array($this->app->environment(), ['staging', 'production'])) {
            \URL::forceScheme('https');
        }

        ini_set('post_max_size', '64M');
        ini_set('upload_max_filesize', '64M');
        ini_set( 'max_execution_time', '300' );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('breadcrumbs', function () {
            return (new Breadcrumbs())->setAttribute('class', 'breadcrumb');
        });

        $this->app->singleton(\Spatie\Html\Html::class, function () {
            return new Html(request());
        });
    }
}
