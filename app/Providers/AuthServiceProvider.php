<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\\Models\\Activity' => 'App\\Policies\\ActivityPolicy',        
        'App\\Models\\Footballer' => 'App\\Policies\\FootballerPolicy',
        'App\\Models\\Export' => 'App\\Policies\\ExportPolicy',
        'App\\Models\\Role' => 'App\\Policies\\RolePolicy',
        'App\\Models\\Setting' => 'App\\Policies\\SettingPolicy',
        'App\\Models\\User' => 'App\\Policies\\UserPolicy',
        'App\\Models\\Webhook' => 'App\\Policies\\WebhookPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::enableImplicitGrant();
    }
}
