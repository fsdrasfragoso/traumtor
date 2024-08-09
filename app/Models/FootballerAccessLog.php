<?php

namespace App\Models;

use App\Libraries\Database\Eloquent\Model;
use App\Models\Relations\BelongsToFootballer;

/**
 * App\Models\FootballerAccessLog
 *
 * @property int $id
 * @property int $footballer_id
 * @property string|null $ip_address
 * @property \Illuminate\Support\Carbon $logged_at
 * @property-read \App\Models\Footballer $footballer
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Libraries\Database\Eloquent\Model adminOrder($order)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Libraries\Database\Eloquent\Model adminSearch($search)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Libraries\Database\Eloquent\Model filter($filter)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FootballerAccessLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FootballerAccessLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FootballerAccessLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FootballerAccessLog whereFootballerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FootballerAccessLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FootballerAccessLog whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FootballerAccessLog whereLoggedAt($value)
 * @mixin \Eloquent
 */
class FootballerAccessLog extends Model
{
    use BelongsToFootballer;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    public $casts = [
        'logged_at' => 'datetime',
    ];
}
