<?php

namespace App\Models\Relations;

use App\Models\Modality;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait BelongsToManyModality {

    /**
     * Represents a database relationship.
     *
     * @return BelongsToMany
     */
    public function modalities(): BelongsToMany
    {
        return $this->belongsToMany(Modality::class, 'footballer_modality');
    }
}
