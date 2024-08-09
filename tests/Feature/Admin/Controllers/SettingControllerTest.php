<?php

namespace Tests\Feature\Admin\Controllers;

use App\Models\Setting;
use Illuminate\Support\Facades\Gate;

class SettingControllerTest extends RouteTest
{
    public $model = Setting::class;

    public function setUp(): void
    {
        parent::setUp();
        $this->signInUser();
        Gate::before(function () {
            return true;
        });
        $this->entity = new Setting();
    }

    public static function routesGet()
    {
        return [
            
        ];
    }
}
