<?php

namespace App\Models;

use App\Models\Relations\BelongsToFootballer;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Libraries\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['footballer_id', 'zip_code', 'street', 'number', 'neighborhood', 'complement', 'state', 'city', 'city_code'];

    use SoftDeletes;
    use BelongsToFootballer;
}
