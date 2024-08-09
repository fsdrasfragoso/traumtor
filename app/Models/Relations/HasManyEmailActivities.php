<?php

namespace App\Models\Relations;

use App\Models\EmailActivity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManyEmailActivities
{
    /**
     * Represents a database relationship.
     *
     * @return HasMany|Builder|EmailActivity[]
     */
    public function email_activities()
    {
        return $this->hasMany(EmailActivity::class);
    }
}