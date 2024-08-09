<?php

namespace App\Models\Relations;

use App\Models\IdentificationField;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManyIdentificationFields {

    /**
     * Represents a database relationship.
     *
     * @return HasMany|Builder|IdentificationField[]
     */
    public function identificationFields()
    {
        return $this->hasMany(IdentificationField::class);
    }
}