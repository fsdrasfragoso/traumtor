<?php

namespace App\Models\Relations;

use App\Models\Modality;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToModality
{
    /**
     * Represents a database relationship.
     *
     * @return BelongsTo
     */
    public function modality(): BelongsTo
    {
        return $this->belongsTo(Modality::class);
    }
}
