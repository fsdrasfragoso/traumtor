<?php

namespace App\Libraries\Database\Eloquent\Concerns;

use Illuminate\Support\Facades\Schema;

trait Fillable
{
    /**
     * Get all fillable attributes
     *
     * @return array
     */
    public function getAllFillable()
    {
        return Schema::getColumnListing($this->getTable());
    }
}
