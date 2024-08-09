<?php

namespace App\Models\Relations;

use App\Models\Email;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

trait MorphManyEmails
{
    /**
     * Represents a database relationship.
     *
     * @return BelongsTo|Builder
     */
    public function emails()
    {
        return $this->morphMany(Email::class, 'notifiable');
    }
}