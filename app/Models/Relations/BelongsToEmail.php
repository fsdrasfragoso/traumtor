<?php

namespace App\Models\Relations;

use App\Models\Email;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToEmail {

    /**
     * Represents a database relationship.
     *
     * @return BelongsTo|Builder|Email
     */
    public function email()
    {
        return $this->belongsTo(Email::class);
    }
}