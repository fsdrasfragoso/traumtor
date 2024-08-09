<?php

namespace App\Http\Requests\Admin;

use App\Models\Position;
use Illuminate\Validation\Rule;

class SavePositionRequest extends CrudRequest
{
    /**
     * Type of class being validated.
     *
     * @var string
     */
    protected $type = Position::class;

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
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'modality_id' => ['required', 'integer', 'exists:modalities,id'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'description.required' => 'O campo descrição é obrigatório.',
            'modality_id.required' => 'O campo modalidade é obrigatório.',
            'modality_id.exists' => 'A modalidade selecionada é inválida.',
        ];
    }
}
