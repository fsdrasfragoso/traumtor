<?php

namespace App\Models\Relations;

use App\Models\FootballMatch;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToFootballMatch
{
    /**
     * Represents a database relationship.
     *
     * @return BelongsTo
     */
    public function footballMatch(): BelongsTo
    {
        return $this->belongsTo(FootballMatch::class);
    }
}
