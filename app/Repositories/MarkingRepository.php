<?php

namespace App\Repositories;

use App\Models\Marking;
use App\Repositories\Concerns\WithSelectOptions;

class MarkingRepository extends CrudRepository
{
    use WithSelectOptions;

    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = Marking::class;

    /**
     * Return the resource main column.
     *
     * @return string
     */
    public function getResourceLabel()
    {
        return 'name';
    }
}
