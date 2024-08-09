<?php

namespace App\Models\Relations;

use App\Models\Footballer;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait BelongsToManyFootballer
{
    /**
     * Represents a database relationship.
     *
     * @return BelongsToMany
     */
    public function footballers(): BelongsToMany
    {
        return $this->belongsToMany(Footballer::class, 'footballer_modality');
    }
}
