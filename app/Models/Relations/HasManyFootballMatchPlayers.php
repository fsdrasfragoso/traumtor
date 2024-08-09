<?php

namespace App\Models\Relations;

use App\Models\FootballMatch;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasManyFootballMatchPlayers
{
    /**
     * Get all the matches the footballer is registered for.
     *
     * @return BelongsToMany
     */
    public function matches(): BelongsToMany
    {
        return $this->belongsToMany(FootballMatch::class, 'football_match_players')
                    ->withPivot('is_present')
                    ->withTimestamps();
    }
}
