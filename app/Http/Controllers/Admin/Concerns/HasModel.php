<?php

namespace App\Http\Controllers\Admin\Concerns;

use App\Repositories\CrudRepository;
use App\Libraries\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

trait HasModel
{
    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType;

    /**
     * Eloquent instance for helper methods.
     *
     * @var Model
     */
    protected $resourceInstance;

    /**
     * Type of the managing repository.
     *
     * @var string
     */
    protected $repositoryType = 'App\\Repositories\\Repository';

    /**
     * Get repository instance for resource.
     *
     * @return CrudRepository
     */
    protected function getRepository()
    {
        return new $this->repositoryType($this->resourceType);
    }

    /**
     * Get resource instance.
     *
     * @return Model
     */
    public function getInstance()
    {
        if (is_null($this->resourceInstance)) {
            $this->resourceInstance = new $this->resourceType;
        }

        return $this->resourceInstance;
    }

    /**
     * Get table name for resource type.
     *
     * @return string
     */
    protected function getTable()
    {
        return $this->getInstance()
            ->getTable();
    }

    /**
     * Create a new query for the resource.
     *
     * @return Builder
     */
    protected function newQuery()
    {
        return $this->getInstance()
            ->newQuery();
    }
}
