<?php

namespace App\Repositories;

use App\Models\FootballerAccessLog;
use App\Repositories\Concerns\WithSelectOptions;

class FootballerAccessLogRepository extends CrudRepository
{

    use WithSelectOptions;


    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = FootballerAccessLog::class;


    /**
     * Return the resource main column.
     *
     * @return string
     */
    public function getResourceLabel()
    {
        return 'ip_address';
    }
}
