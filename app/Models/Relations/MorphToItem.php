<?php

namespace App\Models\Relations;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphTo;

trait MorphToItem
{
    /**
     * Represents a database relationship.
     *
     * @return MorphTo|Builder
     */
    public function item()
    {
        return $this->morphTo();
    }
}
