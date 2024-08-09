<?php

namespace App\Models\Relations;

use App\Models\Position;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait BelongsToManyPosition {

    /**
     * Represents a database relationship.
     *
     * @return BelongsToMany
     */
    public function positions()
    {
        return $this->belongsToMany(Position::class, 'footballer_position');
    }
}
