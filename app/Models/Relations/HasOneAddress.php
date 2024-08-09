<?php

namespace App\Models\Relations;

use App\Models\Address;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait HasOneAddress {

    /**
     * Represents a database relationship.
     *
     * @return HasOne|Builder|Address
     */
    public function address()
    {
        return $this->hasOne(Address::class);
    }
}