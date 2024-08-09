<?php

namespace App\Http\Requests\Admin;

use App\Models\Modality;
use Illuminate\Validation\Rule;

class SaveModalityRequest extends CrudRequest
{
    /**
     * Type of class being validated.
     *
     * @var string
     */
    protected $type = Modality::class;

    /**
     * Rules when editing resource.
     *
     * @return array
     */
    protected function editRules()
    {
        return [];
    }

    /**
     * Rules when creating resource.
     *
     * @return array
     */
    protected function createRules()
    {
        return [];
    }

    /**
     * Base rules for both creating and editing the resource.
     *
     * @return array
     */
    public function baseRules()
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('modalities', 'name')],
            'player_count' => ['required', 'integer', 'min:4'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.unique' => 'O nome já está em uso.',
            'player_count.required' => 'O campo player_count é obrigatório.',
            'player_count.integer' => 'O campo player_count deve ser um número inteiro.',
            'player_count.min' => 'O campo player_count deve ser no mínimo 4.',
        ];
    }
}
