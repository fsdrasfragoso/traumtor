<?php

namespace App\Libraries\Database\Eloquent\Concerns;

use Illuminate\Database\Query\Builder;

trait ArrayFilterable
{
    /**
     * Executes filter on query.
     *
     * @param Builder $query
     * @param callable $filter
     * @return Builder
     */
    public function scopeArrayFilter($query, $filter, $params)
    {
        return call_user_func_array($filter, [$query, $params]);
    }
}
