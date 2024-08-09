<?php

namespace App\Models\Relations;

use App\Models\FootballerAccessLog;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManyFootballerAccessLogs
{
    /**
     * Represents a database relationship.
     *
     * @return HasMany|Builder|Access[]|Access
     */
    public function accessLogs()
    {
        return $this->hasMany(FootballerAccessLog::class);
    }
}
