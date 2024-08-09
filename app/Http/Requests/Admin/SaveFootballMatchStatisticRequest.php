<?php

namespace App\Http\Requests\Admin;

use App\Models\FootballMatchStatistic;
use Illuminate\Validation\Rule;

class SaveFootballMatchStatisticRequest extends CrudRequest
{
    /**
     * Type of class being validated.
     *
     * @var string
     */
    protected $type = FootballMatchStatistic::class;

    /**
     * Rules when creating resource.
     *
     * @return array
     */
    protected function createRules()
    {
        return [
            'football_match_id' => ['required', 'integer', 'exists:football_matches,id'],
            'footballer_id' => ['required', 'integer', 'exists:footballers,id'],
            'goals' => ['required', 'integer', 'min:0'],
            'fouls_committed' => ['required', 'integer', 'min:0'],
            'tackles' => ['required', 'integer', 'min:0'],
            'assists' => ['required', 'integer', 'min:0'],
            'successful_dribbles' => ['required', 'integer', 'min:0'],
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
            'football_match_id' => ['required', 'integer', 'exists:football_matches,id'],
            'footballer_id' => ['required', 'integer', 'exists:footballers,id'],
            'goals' => ['required', 'integer', 'min:0'],
            'fouls_committed' => ['required', 'integer', 'min:0'],
            'tackles' => ['required', 'integer', 'min:0'],
            'assists' => ['required', 'integer', 'min:0'],
            'successful_dribbles' => ['required', 'integer', 'min:0'],
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
