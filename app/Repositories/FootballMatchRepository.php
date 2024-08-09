<?php

namespace App\Repositories;

use App\Models\FootballMatch;
use App\Repositories\Concerns\WithSelectOptions;

class FootballMatchRepository extends CrudRepository
{
    use WithSelectOptions;

    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = FootballMatch::class;

    /**
     * Return the resource main column.
     *
     * @return string
     */
    public function getResourceLabel()
    {
        return 'local_name'; // Substitua 'local_name' pelo nome da coluna principal do modelo FootballMatch
    }
}
