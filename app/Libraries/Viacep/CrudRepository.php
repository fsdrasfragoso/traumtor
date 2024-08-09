<?php

namespace App\Libraries\Viacep;

use Illuminate\Support\Collection;

class CrudRepository
{
    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType;

    /**
     * Fluent instance for helper methods.
     *
     * @var Model
     */
    protected $resourceInstance;

    /**
     * Repository constructor.
     *
     * @param string $resourceType
     */
    public function __construct($resourceType = null)
    {
        if ($resourceType) {
            $this->resourceType = $resourceType;
        }
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
     * Get name for resource type.
     *
     * @return string
     */
    protected function getName()
    {
        return $this->getInstance()
            ->getName();
    }

    /**
     * Display a listing of the resource.
     *
     * @param $params
     * @return Collection|Model[]
     */
    public function index($params)
    {

    }

    /**
     * Find the specified resource.
     *
     * @param int $id
     * @return Model
     */
    public function find($id)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $attributes
     * @return Model
     */
    public function create($attributes)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Model $resource
     * @param array $attributes
     * @return Model
     */
    public function update($resource, $attributes)
    {

    }

}
