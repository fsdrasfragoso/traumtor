<?php

namespace App\Models\Relations;

use App\Models\GroupModalitySchedule;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManySchedules
{
    /**
     * Represents a "Has Many" database relationship.
     *
     * @return HasMany
     */
    public function schedules(): HasMany
    {
        return $this->hasMany(GroupModalitySchedule::class, 'group_modality_schedule_id');
    }
}
