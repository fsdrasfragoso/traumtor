<?php

namespace App\Http\Requests\Admin;

use App\Models\Marking;
use Illuminate\Validation\Rule;

class SaveMarkingRequest extends CrudRequest
{
    /**
     * Type of class being validated.
     *
     * @var string
     */
    protected $type = Marking::class;

    /**
     * Rules when editing resource.
     *
     * @return array
     */
    protected function editRules()
    {
        return [
            'name' => [
                'required', 'string', 'max:255',
                Rule::unique('markings')->where(function ($query) {
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
                'required', 'string', 'max:255',
                Rule::unique('markings')->where(function ($query) {
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
            'description' => ['required', 'string'],
            'advantages' => ['required', 'string'],
            'disadvantages' => ['required', 'string'],
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
            'name.unique' => 'Já existe uma marcação com esse nome para a modalidade selecionada.',
            'description.required' => 'O campo descrição é obrigatório.',
            'advantages.required' => 'O campo vantagens é obrigatório.',
            'disadvantages.required' => 'O campo desvantagens é obrigatório.',
            'modality_id.required' => 'O campo modalidade é obrigatório.',
            'modality_id.exists' => 'A modalidade selecionada é inválida.',
        ];
    }
}
