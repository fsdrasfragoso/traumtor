<?php

namespace App\Libraries\Database\Eloquent\Concerns;

use App\Models\Content;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;

trait Publishable
{
    /**
     * With valid publication dates.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopePublished($query)
    {
        $currentTime = Carbon::now()->format('Y-m-d H:i:s');

        return $query->where($this->getTable() . '.published_at', '<=', $currentTime)
            ->where(function ($query) use ($currentTime) {
                /** @var Builder $query */
                $query->whereNull($this->getTable() . '.unpublished_at')
                    ->orWhere($this->getTable() . '.unpublished_at', '>=', $currentTime);
            });
    }

    /**
     * Have valid publication dates.
     *
     * @return bool
     */
    public function isPublished()
    {
        $currentTime = Carbon::now();

        return $this->published_at <= $currentTime &&
            (is_null($this->unpublished_at) ||
                $this->unpublished_at >= $currentTime);
    }
}
