<?php

namespace App\Models\Relations;

use App\Models\FootballMatch;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManyFootballMatches
{
    /**
     * Represents a database relationship.
     *
     * @return HasMany
     */
    public function footballMatches(): HasMany
    {
        return $this->hasMany(FootballMatch::class, 'scheduled_by');
    }
}
