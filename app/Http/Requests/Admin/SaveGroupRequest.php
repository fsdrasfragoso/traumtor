<?php

namespace App\Http\Requests\Admin;

use App\Models\Group;
use Illuminate\Validation\Rule;

class SaveGroupRequest extends CrudRequest
{
    /**
     * Type of class being validated.
     *
     * @var string
     */
    protected $type = Group::class;

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
            'street' => ['required', 'string', 'max:255'],
            'number' => ['required', 'string', 'max:10'],
            'zip_code' => ['required', 'string', 'max:10'],
            'neighborhood' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:2'],
            'schedules' => ['required'],            
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',            
            'street.required' => 'O campo rua é obrigatório.',
            'number.required' => 'O campo número é obrigatório.',
            'zip_code.required' => 'O campo CEP é obrigatório.',
            'neighborhood.required' => 'O campo bairro é obrigatório.',
            'city.required' => 'O campo cidade é obrigatório.',
            'state.required' => 'O campo estado é obrigatório.',
            'schedules.required' => 'O campo horários é obrigatório.',
            'modality_id.required' => 'O campo modalidade é obrigatório.',           
        ];
    }
}
