<?php

namespace App\Models\Relations;

use App\Models\GroupModalitySchedule;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToGroupModalitySchedule
{
    /**
     * Represents a database relationship.
     *
     * @return BelongsTo
     */
    public function schedule(): BelongsTo
    {
        return $this->belongsTo(GroupModalitySchedule::class, 'group_modality_schedule_id');
    }
}
