<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Footballer;
use Illuminate\Http\JsonResponse;
use App\Repositories\FootballerRepository;


class FootballerController extends FrontendController
{
    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = Footballer::class;

    /**
     * Type of the managing repository.
     *
     * @var string
     */
    protected $repositoryType = FootballerRepository::class;


    /**
     * Retorna os dados do usuário logado.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLoggedFootballer()
    {
       
        $footballer = footballer(); // Usa a função helper para obter o usuário logado

        if ($footballer) {
            return response()->json([
                'success' => true,
                'footballer' => $footballer,
                'modalities' =>$footballer->modalities,
                'positions' => $footballer->positions
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Nenhum usuário autenticado',
        ], 401);
    }

    /**
     * Retorna todos os dados de um futebolista específico.
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show(Request $request, $id)
    {
        $footballer = Footballer::find($id);

        if (!$footballer) {
            return response()->json(['error' => 'Futebolista não encontrado'], 404);
        }

        return response()->json($footballer, 200);
    }

    /**
     * Atualiza os dados de um futebolista específico.
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $footballer = Footballer::find($id);

        if (!$footballer) {
            return response()->json(['error' => 'Futebolista não encontrado'], 404);
        }

        $footballer->update($request->all());

        return $this->afterUpdate($footballer);
    }

    /**
     * Exclui um futebolista específico.
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function delete(Request $request, $id)
    {
        $footballer = Footballer::find($id);

        if (!$footballer) {
            return response()->json(['error' => 'Futebolista não encontrado'], 404);
        }

        $footballer->delete();

        return $this->afterDelete($footballer);
    }
}
