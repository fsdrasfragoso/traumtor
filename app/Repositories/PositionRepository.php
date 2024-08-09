<?php

namespace App\Repositories;

use App\Models\Position;
use App\Repositories\Concerns\WithSelectOptions;

class PositionRepository extends CrudRepository
{
    use WithSelectOptions;

    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = Position::class;

    /**
     * Return the resource main column.
     *
     * @return string
     */
    public function getResourceLabel()
    {
        return 'name'; // Nome da coluna principal do modelo Position
    }
}
