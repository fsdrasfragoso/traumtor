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
            'group_modality_schedule_id' => ['required'],           
            
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
            'group_modality_schedule_id' => ['required'],
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
