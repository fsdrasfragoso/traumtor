<?php

namespace App\Http\Requests\Admin;

use App\Models\FootballMatchPlayers;
use Illuminate\Validation\Rule;

class SaveFootballMatchPlayersRequest extends CrudRequest
{
    /**
     * Type of class being validated.
     *
     * @var string
     */
    protected $type = FootballMatchPlayers::class;

    /**
     * Rules when creating resource.
     *
     * @return array
     */
    protected function createRules()
    {
        return [
            'is_present' => ['required'],           
            
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
            'is_present' => ['required'],
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
