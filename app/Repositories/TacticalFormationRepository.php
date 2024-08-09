<?php

namespace App\Repositories;

use App\Models\TacticalFormation;
use App\Repositories\Concerns\WithSelectOptions;

class TacticalFormationRepository extends CrudRepository
{
    use WithSelectOptions;

    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = TacticalFormation::class;

    /**
     * Return the resource main column.
     *
     * @return string
     */
    public function getResourceLabel()
    {
        return 'name'; // Nome da coluna principal do modelo TacticalFormation
    }
}
