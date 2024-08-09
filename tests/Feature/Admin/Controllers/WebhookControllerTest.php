<?php


namespace Tests\Feature\Admin\Controllers;


use App\Models\Webhook;
use Illuminate\Support\Facades\Gate;

class WebhookControllerTest extends RouteTest
{
    public $model = Webhook::class;
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
            ['web.admin.webhooks.index'],
        ];
    }
}
