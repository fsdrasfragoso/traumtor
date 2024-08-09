<?php

namespace App\Repositories;

use App\Models\EmailActivity;

class EmailActivityRepository extends CrudRepository
{
    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = EmailActivity::class;
    
}
