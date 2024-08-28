<?php

namespace App\Repositories;

use App\Models\FootballMatchPlayers;
use App\Repositories\Concerns\WithSelectOptions;

class FootballMatchPlayersRepository extends CrudRepository
{
    use WithSelectOptions;

    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = FootballMatchPlayers::class;

    /**
     * Return the resource main column.
     *
     * @return string
     */
    public function getResourceLabel()
    {
        return 'football_match_id'; 
    }

    
}
