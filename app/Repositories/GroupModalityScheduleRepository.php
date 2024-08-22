<?php

namespace App\Repositories;

use App\Models\GroupModalitySchedule;
use App\Repositories\Concerns\WithSelectOptions;

class GroupModalityScheduleRepository extends CrudRepository
{
    use WithSelectOptions;

    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = GroupModalitySchedule::class;

    /**
     * Return the resource main column.
     *
     * @return string
     */
    public function getResourceLabel()
    {
        return 'day'; 
    }
}
