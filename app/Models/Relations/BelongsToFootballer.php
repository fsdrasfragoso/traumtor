<?php

namespace App\Models\Relations;

use App\Models\Footballer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToFootballer {

    /**
     * Represents a database relationship.
     *
     * @return BelongsTo|Builder|Footballer
     */
    public function footballer()
    {
        return $this->belongsTo(Footballer::class);
    }
}