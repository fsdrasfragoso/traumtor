<?php

namespace App\Models\Relations;

use App\Models\Footballer;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasManyFootballers
{
    /**
     * Get all the footballers registered for the match.
     *
     * @return BelongsToMany
     */
    public function players(): BelongsToMany
    {
        return $this->belongsToMany(Footballer::class, 'football_match_players')
                    ->withPivot('is_present')
                    ->withTimestamps();
    }
}
