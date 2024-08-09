<?php

namespace Tests\Feature\Admin\Controllers;

use App\Models\Export;

use Illuminate\Support\Facades\Gate;

class ExportControllerTest extends RouteTest
{
    public $model = Export::class;
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
            ['web.admin.exports.index'],
            ['web.admin.exports.download','export'],
        ];
    }
}
