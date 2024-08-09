<?php


namespace Tests\Feature\Admin\Controllers;


use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UserControllerTest extends RouteTest
{
    public $model = User::class;
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
            ['web.admin.users.index'],
            ['web.admin.users.create'],
        ];
    }
}
