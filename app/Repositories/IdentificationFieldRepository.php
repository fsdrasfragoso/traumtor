<?php

namespace App\Repositories;

use App\Models\IdentificationField;
use Illuminate\Database\Eloquent\Builder;

class IdentificationFieldRepository extends CrudRepository
{
    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = IdentificationField::class;
}
