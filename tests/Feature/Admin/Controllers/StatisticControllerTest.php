<?php


namespace Tests\Feature\Admin\Controllers;

use Illuminate\Support\Facades\Gate;

class StatisticControllerTest extends RouteTest
{
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
            ['web.admin.statistics.payments_sum_total'],
        ];
    }
}
