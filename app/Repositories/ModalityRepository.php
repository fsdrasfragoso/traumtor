<?php

namespace App\Repositories;

use App\Models\Modality;
use App\Repositories\Concerns\WithSelectOptions;

class ModalityRepository extends CrudRepository
{
    use WithSelectOptions;

    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = Modality::class;

    /**
     * Return the resource main column.
     *
     * @return string
     */
    public function getResourceLabel()
    {
        return 'name'; // Nome da coluna principal do modelo Modality
    }
}
