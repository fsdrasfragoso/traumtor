<?php

namespace Tests\Feature\Admin\Controllers;

use App\Models\Role;
use Illuminate\Support\Facades\Gate;

class RoleControllerTest extends RouteTest
{
    public $model = Role::class;
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
            ['web.admin.roles.index'],
            ['web.admin.roles.create'],
        ];
    }
}
