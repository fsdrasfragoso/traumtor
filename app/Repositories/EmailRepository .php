<?php

namespace App\Repositories;

use App\Models\Email;
use App\Repositories\Concerns\WithSelectOptions;

class EmailRepository extends CrudRepository
{
    use WithSelectOptions;

    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = Email::class;

    /**
     * Return the resource main column.
     *
     * @return string
     */
    public function getResourceLabel()
    {
        return 'subject'; // Substitua 'subject' pelo nome da coluna principal do modelo Email
    }
}
