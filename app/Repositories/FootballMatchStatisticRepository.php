<?php

namespace App\Repositories;

use App\Models\FootballMatchStatistic;
use App\Repositories\Concerns\WithSelectOptions;

class FootballMatchStatisticRepository extends CrudRepository
{
    use WithSelectOptions;

    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = FootballMatchStatistic::class;

    /**
     * Return the resource main column.
     *
     * @return string
     */
    public function getResourceLabel()
    {
        return 'id'; // Substitua 'id' pelo nome da coluna principal do modelo FootballMatchStatistic
    }
}
