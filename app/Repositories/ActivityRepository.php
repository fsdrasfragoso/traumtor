<?php

namespace App\Repositories;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class ActivityRepository extends CrudRepository
{
    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = Activity::class;

    /**
     * Apply filters
     *
     * @param Builder $query
     * @param array $params
     * @return Builder
     */
    public function applyFilter($query, $params)
    {
        $user = user();

        if (!$user) {
            $user_id = data_get($params, 'user_id');
            $user = User::find($user_id);
        }

        return $query->select('activity_log.*')
            ->when(!$user->isSuper(), function (Builder $query) {
                $query->where('activity_log.description', '!=', 'download');
            });
    }

    /**
     * Display a listing of the resource.
     *
     * @param $params
     * @return Collection|Model[]
     */
    public function index($params)
    {
        $subject_id = preg_replace('/\D/', '', data_get($params, 'q.subject_id.equals', ''));
        data_set($params, 'q.subject_id.equals', $subject_id);

        $search = data_get($params, 'q');
        $order = data_get($params, 'order');

        /** @noinspection PhpUndefinedMethodInspection */
        return $this->newQuery()
            ->select($this->indexColumns())
            ->filter([$this, 'indexFilter'])
            ->adminSearch($search)
            ->adminOrder($order)
            ->paginate()
            ->appends($params);
    }
}
