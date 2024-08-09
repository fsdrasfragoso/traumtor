<?php


namespace Tests\Feature\Admin\Controllers;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Routing\RouteCollection;
use Tests\TestCase;

abstract class RouteTest extends TestCase
{
    use DatabaseTransactions;

    public $model = null;
    public $entity = null ;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     * @dataProvider   routesGet
     */
    public function it_should_return_success_to_GET_request($name,$modelAlias = null)
    {
        $this->withoutExceptionHandling();
        /** @var RouteCollection $routes */
        $routes = app('router')->getRoutes();
        $route = $routes->getByName($name);
        $url = $route->uri();
        if(count($route->parameterNames() ?? []) > 0 && $this->model != null) {
            $this->createEntity();
            foreach ($route->parameterNames as $parameterName){
                if($parameterName == $modelAlias){
                    $value = $this->entity->id;
                }else {
                    $value = data_get($this->entity, $parameterName,null);
                    if(!$value){
                        $this->fail("Parameter '$parameterName' not found");
                    }
                }
                $url = str_replace('{'.$parameterName.'}',$value,$url);
            }
        }else if(count($route->parameterNames() ?? []) > 0 && $this->model == null){
            $this->fail("No Model set, to url: ".$url );
        }
        $response = $this->get($url);
        $response->assertSessionDoesntHaveErrors();
        $response->assertStatus(200);
    }

    public static function routesGet()
    {
        return [
            ['web.frontend.default.index'],
        ];
    }

    public function createEntity()
    {
        if($this->model) {
            try {
                $this->entity = $this->model::factory()->create();
            } catch(\InvalidArgumentException $e) {
                $this->entity = $this->model::firstOrFail();
                if($this->entity == null) {
                    $this->fail("No Factory for Model ".$this->model );
                }
            }
        }
    }
}
