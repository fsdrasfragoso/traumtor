<?php

namespace App\Http\Requests\Admin;

use App\Models\TacticalFormation;
use App\Rules\ValidTacticalFormationName;
use Illuminate\Validation\Rule;

class SaveTacticalFormationRequest extends CrudRequest
{
    /**
     * Type of class being validated.
     *
     * @var string
     */
    protected $type = TacticalFormation::class;

    /**
     * Rules when editing resource.
     *
     * @return array
     */
    protected function editRules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                new ValidTacticalFormationName($this->input('modality_id')),
                Rule::unique('tactical_formations')->where(function ($query) {
                    return $query->where('modality_id', $this->input('modality_id'))->where('id', '!=', $this->route('id'));
                }),
            ],
        ];
    }

    /**
     * Rules when creating resource.
     *
     * @return array
     */
    protected function createRules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                new ValidTacticalFormationName($this->input('modality_id')),
                Rule::unique('tactical_formations')->where(function ($query) {
                    return $query->where('modality_id', $this->input('modality_id'));
                }),
            ],
        ];
    }

    /**
     * Base rules for both creating and editing the resource.
     *
     * @return array
     */
    public function baseRules()
    {
        return [
            'description' => ['nullable', 'string'],
            'modality_id' => ['required', 'integer', 'exists:modalities,id'],
        ];
    }

    /**
     * Custom messages for validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.unique' => 'Já existe uma formação com esse nome para a modalidade selecionada.',
            'description.required' => 'O campo descrição é obrigatório.',
            'modality_id.required' => 'O campo modalidade é obrigatório.',
            'modality_id.exists' => 'A modalidade selecionada é inválida.',
        ];
    }
}
