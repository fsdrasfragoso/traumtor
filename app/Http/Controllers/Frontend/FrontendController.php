<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Libraries\Database\Eloquent\Model;
use App\Http\Controllers\Admin\Concerns\HasModel;

abstract class FrontendController extends Controller
{

    use HasModel;


    /**
     * Instância limpa do recurso.
     *
     * @var Model
     */
    protected $instance;

    /**
     * Construtor do controlador.
     */
    public function __construct()
    {
        $this->instance = $this->getRepository()->getInstance();
    }

    /**
     * Exibe uma listagem do recurso.
     *
     * @param Request $request
     *
     * @return View|Response
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        

        $resources = $this->getRepository()->index($request->all());

        if ($request->expectsJson()) {
            return response()->json($resources, 200);
        }

        return $this->view('index')
            ->with('type', $this->resourceType)
            ->with('instance', $this->instance)
            ->with('resources', $resources);
    }

    /**
     * Exibe o recurso especificado.
     *
     * @param Request $request
     * @param int $id
     *
     * @return View|Response
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Request $request, $id)
    {
        $instance = $this->getRepository()->find($id, true);

       
        if ($request->expectsJson()) {
            return response()->json($instance, 200);
        }

        return $this->view('show')
            ->with('type', $this->resourceType)
            ->with('instance', $instance);
    }

    /**
     * Armazena um novo recurso.
     *
     * @param Request $request
     * @return RedirectResponse|Response
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request)
    {
       
        $params = $this->formParams();

        if ($resource = $this->getRepository()->create($params)) {
            return $this->afterCreate($request, $resource);
        }

        return $this->afterFailed($request, 'created');
    }

    /**
     * Atualiza o recurso especificado.
     *
     * @param Request $request
     * @param int $id
     *
     * @return RedirectResponse|Response
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, $id)
    {
        $instance = $this->getRepository()->find($id, true);       

        if ($resource = $this->getRepository()->update($instance, $this->formParams())) {
            return $this->afterUpdate($resource);
        }

        return $this->afterFailed($request, 'updated');
    }

    /**
     * Remove o recurso especificado do armazenamento.
     *
     * @param Request $request
     * @param int $id
     *
     * @return RedirectResponse|Response
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete(Request $request, $id)
    {
        $instance = $this->getRepository()->find($id, true);       

        if ($success = $this->getRepository()->delete($instance)) {
            return $this->afterDelete($instance);
        }

        return $this->afterFailed($request, 'deleted');
    }

    /**
     * Implementa a lógica após a criação de um recurso.
     *
     * @param Request $request
     * @param Model $resource
     *
     * @return RedirectResponse|Response
     */
    protected function afterCreate(Request $request, $resource)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Recurso criado com sucesso.',
                'data' => $resource
            ], 201);
        }

        return redirect()
            ->route($this->resourceType . '.show', $resource->id)
            ->with('success', 'Recurso criado com sucesso.');
    }

    /**
     * Implementa a lógica após a atualização de um recurso.
     *
     * @param Model $resource
     *
     * @return RedirectResponse|Response
     */
    protected function afterUpdate($resource)
    {
        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Recurso atualizado com sucesso.',
                'data' => $resource
            ], 200);
        }

        return redirect()
            ->route($this->resourceType . '.show', $resource->id)
            ->with('success', 'Recurso atualizado com sucesso.');
    }

    /**
     * Implementa a lógica após a exclusão de um recurso.
     *
     * @param Model $resource
     *
     * @return RedirectResponse|Response
     */
    protected function afterDelete($resource)
    {
        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Recurso excluído com sucesso.'
            ], 200);
        }

        return redirect()
            ->route($this->resourceType . '.index')
            ->with('success', 'Recurso excluído com sucesso.');
    }

    /**
     * Implementa a lógica após a falha em uma operação.
     *
     * @param Request $request
     * @param string $action
     *
     * @return RedirectResponse|Response
     */
    protected function afterFailed(Request $request, $action)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => "Falha ao $action o recurso."
            ], 400);
        }

        return redirect()
            ->back()
            ->withInput()
            ->with('error', "Falha ao $action o recurso.");
    }

}
