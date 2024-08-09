<?php

namespace App\Models;

use App\Libraries\Database\Eloquent\Model;
use App\Models\Concerns\WithFootballersNameAdminColumn;
use App\Models\Concerns\WithIdAdminColumn;
use App\Models\Concerns\WithUsersNameAdminColumn;
use App\Models\Relations\BelongsToFootballer;
use App\Models\Relations\BelongsToUser;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * App\Models\FootballerActivity
 *
 * @property int $id
 * @property int $footballer_id
 * @property int $user_id
 * @property bool $answered_call
 * @property string|null $call_reason
 * @property \Illuminate\Support\Carbon $called_at
 * @property bool $already_invest
 * @property array $financial_assets
 * @property array $footballer_profile
 * @property array $footballer_style
 * @property int|null $invested
 * @property int|null $to_invest
 * @property string|null $purchased
 * @property string|null $purchased_reason
 * @property \Illuminate\Support\Carbon|null $call_in
 * @property string|null $observations
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Footballer $footballer
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $dontLikeProducts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $offeredProducts
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Libraries\Database\Eloquent\Model adminOrder($order)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Libraries\Database\Eloquent\Model adminSearch($search)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Libraries\Database\Eloquent\Model filter($filter)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FootballerActivity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FootballerActivity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FootballerActivity query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FootballerActivity whereAlreadyInvest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FootballerActivity whereAnsweredCall($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FootballerActivity whereCallIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FootballerActivity whereCallReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FootballerActivity whereCalledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FootballerActivity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FootballerActivity whereFootballerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FootballerActivity whereFootballerProfile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FootballerActivity whereFootballerStyle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FootballerActivity whereFinancialAssets($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FootballerActivity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FootballerActivity whereInvested($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FootballerActivity whereObservations($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FootballerActivity wherePurchased($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FootballerActivity wherePurchasedReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FootballerActivity whereToInvest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FootballerActivity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FootballerActivity whereUserId($value)
 * @mixin \Eloquent
 */
class FootballerActivity extends Model
{
    use WithIdAdminColumn;
    use WithUsersNameAdminColumn;
    use WithFootballersNameAdminColumn;
    use BelongsToUser;
    use BelongsToFootballer;
  

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'called_at' => 'datetime',
        'call_in' => 'datetime',
        'financial_assets' => 'json',
        'footballer_profile' => 'json',
        'footballer_style' => 'json',
    ];

    /**
     * Get default order key.
     *
     * @return string
     */
    public function getOrderKey()
    {
        return 'created_at';
    }

    /**
     * Get default order direction.
     *
     * @return string
     */
    public function getOrderDir()
    {
        return 'desc';
    }

    /**
     * List of headers for the admin listing table.
     *
     * @return array
     */
    public function getAdminColumns()
    {
        $columns = [
            'protocol',
            'called_at',
            'footballers_name',
            'answered_call',
            'purchased',
            'call_in',
            'observations',
            'created_at',
        ];

         if (user()->isSuper()){
             array_splice( $columns, 2, 0, ['users_name'] );
         }

        return $columns;
    }

    public function getExportColumns()
    {
        return [
            'protocol',
            'footballers_name',
            'users_name',
            'created_at',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    

    /**
     * If this column should expand.
     *
     * @param int $index
     * @param string $attribute
     * @return bool
     */
    public function getAdminColumnExpand($index, $attribute)
    {
        return in_array($attribute, ['observations', 'footballers_name', 'users_name']);
    }

    /**
     * Get answered call admin column.
     *
     * @param bool $export
     * @return string
     */
    public function getPurchasedAdminColumn($export = false)
    {
        return '<span class="d-block text-center w-100">'. modelAttribute(self::class, 'options.purchased.'.$this->purchased) . '</span>';
    }

    /**
     * Get answered call admin column.
     *
     * @param bool $export
     * @return string
     */
    public function getAnsweredCallAdminColumn($export = false)
    {
        if ($export) {
            return $this->getKey();
        }

        return $this->answered_call ? '<span class="d-block text-center w-100">Sim</span>' : '<span class="d-block text-center w-100">Não</span>';
    }

    /**
     * Get protocol admin column.
     *
     * @param bool $export
     * @return string
     */
    public function getProtocolAdminColumn($export = false)
    {
        if ($export) {
            return $this->getKey();
        }

        return html()->a($this->route('show'), '#'.$this->getKey())->data('pjax', true);
    }
}
