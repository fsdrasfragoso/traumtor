<?php

namespace App\Models\Relations;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToUser
{
    /**
     * Represents a database relationship.
     *
     * @return BelongsTo|Builder|User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUserWithTrashed()
    {
        return $this->user()->withTrashed()->first();
    }
}
