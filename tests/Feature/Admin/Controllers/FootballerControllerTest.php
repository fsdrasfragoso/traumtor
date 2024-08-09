<?php

namespace Tests\Feature\Admin\Controllers;

use App\Models\Footballer;
use Illuminate\Support\Facades\Gate;

class FootballerControllerTest extends RouteTest
{
    public $model = Footballer::class;
    public function setUp(): void
    {
        parent::setUp();
        $this->signInUser();
        Gate::before(function () {
            return true;
        });
    }

    public static function routesGet()
    {
        return [
            ['web.admin.footballers.index'],
            ['web.admin.footballers.create'],

        ];
    }
}
