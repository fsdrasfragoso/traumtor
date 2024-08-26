<?php

namespace App\Models\Relations;

use App\Models\Group;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait BelongsToManyGroup {

    /**
     * Represents a database relationship.
     *
     * @return BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_footballer');
    }
}
