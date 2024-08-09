<?php

namespace App\Providers;

use App\Models\Setting;
use Exception;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (!$this->hasSettingsTable()) {
            return;
        }

        $registry = $original = [];

        Setting::query()
            ->where('autoload', true)
            ->get()
            ->each(function ($item) use (&$registry, &$original) {
                $registry[$item->meta_key] = $item->meta_value;
                $original[$item->meta_key] = $item->meta_value;
            });

        $registry['settings.__old'] = $original;

        config($registry);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        if (!$this->hasSettingsTable()) {
            return;
        }

        /** @var Application $app */
        $app = $this->app;

        $app->terminating(function () {
            $original = config('settings.__old');
            $new = config('settings');

            unset($new['__old']);

            foreach ($new as $key => $value) {
                if (array_key_exists($key, $original)) {
                    if (json_encode($new[$key]) === json_encode($original[$key])) {
                        unset($new[$key]);
                    }
                }
            }

            array_walk($new, function ($value, $key) use ($new) {
                $setting = Setting::query()
                    ->firstOrNew(['meta_key' => $key]);

                $setting->meta_value = $value;
                $setting->save();
            });
        });
    }

    /**
     * Settings migration already ran?
     *
     * @return bool
     */
    protected function hasSettingsTable()
    {
        try {
            return Schema::hasTable((new Setting)->getTable());
        } catch (Exception $e) {
            return false;
        }
    }
}
