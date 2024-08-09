<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(1000)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware(['api', 'cors'])
                ->prefix('api')
                ->group(fn () => $this->mapRoutesFromDirectory(base_path('routes/api')));

            Route::middleware('web')
                ->group(fn () => $this->mapRoutesFromDirectory(base_path('routes/web')));
        });
    }

    private function mapRoutesFromDirectory(string $directory)
    {
        $finder = new Finder();
        $finder->files()->in($directory)->name('*.php');

        foreach ($finder as $file) {
            if ($file instanceof SplFileInfo) {
                $routePath = $file->getRealPath();
                Route::group([], $routePath);
            }
        }
    }
}
