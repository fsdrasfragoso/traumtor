<?php

namespace App\Repositories;

use App\Models\Export;
use Illuminate\Database\Eloquent\Builder;
use App\Repositories\Concerns\WithSelectOptions;

class ExportRepository extends CrudRepository
{

    use WithSelectOptions;

    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = Export::class;

    /**
     * Apply filters
     *
     * @param Builder $query
     * @param array $params
     * @return Builder
     */
    public function applyFilter($query, $params)
    {
        return $query->select('exports.*')
            ->leftJoin('users', 'exports.user_id', '=', 'users.id')
            ->when(!user()->isSuper(), function (Builder $query) {
                $query->where('exports.user_id', user()->id);
            });
    }

    public function modelOptions()
    {
        $sections = $this->newQuery()
            ->orderBy('model')
            ->groupBy('model')
            ->pluck('model');
        return $sections->mapWithKeys(function ($item) {
            return [$item => modelName($item)];
        });
    }

     /**
     * Return the resource main column.
     *
     * @return string
     */
    public function getResourceLabel()
    {
        return 'model';
    }


}
