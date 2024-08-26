<?php

namespace App\Repositories;

use App\Libraries\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CrudRepository extends Repository
{

        
    /**
     * Display a listing of the resource.
     *
     * @param $params
     *
     * @return Collection|Model[]
     */
    public function index($params)
    {
        
        $search = data_get($params, 'q');
        $order = data_get($params, 'order');

        /* @noinspection PhpUndefinedMethodInspection */
        return $this->newQuery()
            ->select($this->indexColumns())
            ->filter([$this, 'indexFilter'])
            ->adminSearch($search)
            ->adminOrder($order)
            ->paginate()
            ->appends($params);
    }

    /**
     * Export.
     *
     * @param $params
     *
     * @return Collection|Model[]
     */
    public function export($params)
    {
        $search = data_get($params, 'q');
        $order = data_get($params, 'order');

        /** @noinspection PhpUndefinedMethodInspection */
        $query = $this->newQuery()
            ->select($this->indexColumns())
            ->adminSearch($search)
            ->adminOrder($order);

        return $this->applyFilter($query, $params)
            ->paginate(1000);
    }

    /**
     * Columns to optimize index query.
     *
     * @return string|array
     */
    public function indexColumns()
    {
        return '*';
    }

    /**
     * Apply filter.
     *
     * @param Builder $query
     * @param array   $params
     *
     * @return Builder
     */
    public function applyFilter($query, $params)
    {
        return $query;
    }

    /**
     * Filter to optimize index query.
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function indexFilter($query)
    {
        $params = request()->all();

        return $this->applyFilter($query, $params);
    }

    /**
     * Find the specified resource.
     *
     * @param int  $id
     * @param bool $trashed
     *
     * @return Model
     */
    public function find($id, $trashed = false, $failNotFound = true)
    {
        $query = $this->newQuery();

        /** @var Builder $query */
        /** @noinspection PhpUndefinedMethodInspection */
        $query = method_exists($this->getInstance(), 'getDeletedAtColumn') && $trashed
            ? $query->withTrashed() : $query;

        /* @noinspection PhpUndefinedMethodInspection */
        $query->select($this->findColumns())
            ->filter([$this, 'findFilter']);
        if ($failNotFound) {
            return $query->findOrFail($id);
        }

        return $query->find($id);
    }

    /**
     * Columns to optimize find query.
     *
     * @return string|array
     */
    public function findColumns()
    {
        return '*';
    }

    /**
     * Filter to optimize find query.
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function findFilter($query)
    {
        return $query;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $attributes
     *
     * @return Model
     */
    public function create($attributes)
    {
        return DB::transaction(function () use ($attributes) {
            $attributes = $this->beforeStore($this->createAttributes($attributes));

            /** @var Model $resource */
            $resource = $this->build($attributes, true);
            $resource->save();

            return $this->afterStore($resource, $attributes);
        });
    }

    /**
     * Create on conflict.
     *
     * @param $attributes
     * @param null   $columnsToUpdate
     * @param string $type
     * @param null   $target
     *
     * @return mixed
     */
    public function createOnConflict($attributes, $columnsToUpdate = null, $type = 'do nothing', $target = null)
    {
        $attributes = $this->createAttributes($attributes);

        /** @var Model $resource */
        $resource = $this->build($attributes, true);

        $values = $resource->toArray();

        /* @var Builder $resource */
        return $this->getInstance()->insertOnConflict($values, $columnsToUpdate, $type, $target);
    }

    /**
     * Handles create action attributes.
     *
     * @param array $attributes
     *
     * @return array
     */
    public function createAttributes($attributes)
    {
        return $this->filterAttributes($attributes);
    }

    /**
     * Handles model before store.
     *
     * @param array $attributes
     *
     * @return array $attributes
     */
    public function beforeStore($attributes)
    {
        return $attributes;
    }
    

    /**
     * Handles model after store.
     *
     * @param Model $resource
     * @param array $attributes
     *
     * @return Model
     */
    public function afterStore($resource, $attributes)
    {
        return $this->afterSave($resource, $attributes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Model $resource
     * @param array $attributes
     *
     * @return Model
     */
    public function update($resource, $attributes)
    {
        return DB::transaction(function () use ($resource, $attributes) {
            $attributes = $this->updateAttributes($attributes);

            /** @var Model $resource */
            $resource = $this->fill($resource, $attributes, true);
            $resource->save();

            return $this->afterUpdate($resource, $attributes);
        });
    }

    /**
     * Handles update action attributes.
     *
     * @param array $attributes
     *
     * @return array
     */
    public function updateAttributes($attributes)
    {
        return $this->filterAttributes($attributes);
    }

    /**
     * Handles model after update.
     *
     * @param Model $resource
     * @param array $attributes
     *
     * @return Model
     */
    public function afterUpdate($resource, $attributes)
    {
        return $this->afterSave($resource, $attributes);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Model $resource
     *
     * @return Model
     */
    public function delete($resource)
    {
        return DB::transaction(function () use ($resource) {
            $resource = $this->beforeDelete($resource);

            $resource->delete();

            return $this->afterDelete($resource);
        });
    }

    /**
     * Handles model before delete.
     *
     * @param Model $resource
     *
     * @return Model
     */
    public function beforeDelete($resource)
    {
        return $resource;
    }

    /**
     * Handles model after delete.
     *
     * @param Model $resource
     *
     * @return Model
     */
    public function afterDelete($resource)
    {
        return $resource;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Model $resource
     *
     * @return Model
     */
    public function restore($resource)
    {
        return DB::transaction(function () use ($resource) {
            $resource = $this->beforeRestore($resource);

            $resource->restore();

            return $this->afterRestore($resource);
        });
    }

    /**
     * Handles model before restore.
     *
     * @param Model $resource
     *
     * @return Model
     */
    public function beforeRestore($resource)
    {
        return $resource;
    }

    /**
     * Handles model after restore.
     *
     * @param Model $resource
     *
     * @return Model
     */
    public function afterRestore($resource)
    {
        return $resource;
    }

    /**
     * Handles model after save.
     *
     * @param Model $resource
     * @param array $attributes
     *
     * @return Model
     */
    public function afterSave($resource, $attributes)
    {
        return $resource;
    }

    /**
     * Filter attributes.
     *
     * @param array $attributes
     *
     * @return array
     */
    public function filterAttributes($attributes)
    {
        return $attributes;
    }
}
