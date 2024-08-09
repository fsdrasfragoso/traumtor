<?php

namespace App\Models\Relations;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphTo;

trait MorphToReference
{
    /**
     * Represents a database relationship.
     *
     * @return MorphTo|Builder
     */
    public function reference()
    {
        return $this->morphTo();
    }
}
