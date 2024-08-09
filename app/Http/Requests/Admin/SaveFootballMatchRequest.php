<?php

namespace App\Http\Requests\Admin;

use App\Models\FootballMatch;
use Illuminate\Validation\Rule;

class SaveFootballMatchRequest extends CrudRequest
{
    /**
     * Type of class being validated.
     *
     * @var string
     */
    protected $type = FootballMatch::class;

    /**
     * Rules when creating resource.
     *
     * @return array
     */
    protected function createRules()
    {
        return [
            'match_datetime' => ['required', 'date'],
            'local_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'zip_code' => ['required', 'string', 'regex:/^\d{5}-\d{3}$/'],
            'modality_id' => ['required', 'integer', 'exists:modalities,id'],
            'scheduled_by' => ['required', 'integer', 'exists:footballers,id'],
        ];
    }

    /**
     * Rules when editing resource.
     *
     * @return array
     */
    protected function editRules()
    {
        return [
            'match_datetime' => ['required', 'date'],
            'local_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'zip_code' => ['required', 'string', 'regex:/^\d{5}-\d{3}$/'],
            'modality_id' => ['required', 'integer', 'exists:modalities,id'],
            'scheduled_by' => ['required', 'integer', 'exists:footballers,id'],
        ];
    }

    /**
     * Base rules for both creating and editing the resource.
     *
     * @return array
     */
    public function baseRules()
    {
        return [];
    }
}
