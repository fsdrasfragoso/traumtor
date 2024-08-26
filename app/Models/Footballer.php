<?php

namespace App\Models;

use App\Libraries\Database\Eloquent\Model;
use App\Models\Concerns\WithIdAdminColumn;
use App\Models\Concerns\WithStatusAdminColumn;
use App\Models\Relations\HasManyFootballerAccessLogs;
use App\Models\Relations\HasManyFootballerActivity;
use App\Models\Relations\HasManyFootballerObservations;
use App\Models\Relations\HasManySubscriptions;
use App\Models\Relations\HasOneAddress;
use App\Models\Relations\MorphManyEmails;
use App\Notifications\ResetFootballerPasswordNotification;
use App\Services\FootballerService;
use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Image\Image;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Relations\BelongsToManyModality;
use App\Models\Relations\BelongsToManyPosition;
use App\Models\Concerns\WithModalitiesAdminColumn;
use App\Models\Concerns\WithPositionsAdminColumn;
use App\Models\Relations\HasManyFootballMatches;
use App\Models\Relations\HasManyFootballMatchPlayers;
use App\Models\Relations\BelongsToManyGroup;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Footballer extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract, HasMedia, JWTSubject
{
    use InteractsWithMedia;
    use Authenticatable;
    use Authorizable;
    use CanResetPassword;
    use HasApiTokens;
    use HasManyFootballerAccessLogs;
    use HasManyFootballMatches;
    use HasOneAddress;
    use LogsActivity;
    use MorphManyEmails;
    use Notifiable;
    use SoftDeletes;
    use WithIdAdminColumn;
    use BelongsToManyModality;
    use BelongsToManyPosition; 
    use WithStatusAdminColumn;
    use WithModalitiesAdminColumn;
    use WithPositionsAdminColumn;
    use HasManyFootballMatchPlayers;
    use BelongsToManyGroup;

    public const STATUS_ACTIVE = 'active';
    public const STATUS_BLOCKED = 'blocked';

    public const SCORE_INVITATIONS = 5;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'last_login_at' => 'datetime',
        'last_content_read_at' => 'datetime',
        'birth_date' => 'date',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

    /**
     * List of headers for the admin listing table.
     *
     * @return array
     */
    public function getAdminColumns()
    {
        return ['id', 'name', 'document', 'email', 'status', 'modalities', 'positions', 'overall', 'dominant_foot', 'created_at'];
    }


    /**
     * Get positions admin column
     *
     * @param bool $export
     * @return mixed|string
     */
    public function getDominantFootAdminColumn($export = false)
    {
        return modelAttribute(self::class, 'options.dominant_foot.' . $this->dominant_foot);
    }

    /**
     * If this column should expand.
     *
     * @param int    $index
     * @param string $attribute
     *
     * @return bool
     */
    public function getAdminColumnExpand($index, $attribute)
    {
        return in_array($attribute, ['email']);
    }

    /**
     * Get status admin column.
     *
     * @return string
     */
    public function getStatusAdminColumn($export = false)
    {
        if ($export) {
            return modelAttribute(self::class, 'options.status.'.$this->status);
        }
        $html = '';
        $html .= '<span class="badge badge-'.($this->status == 'active' ? 'success' : 'danger').'">'.modelAttribute(self::class, 'options.status.'.$this->status).'</span>';

        return $html;
    }

    public function getAdminActions()
    {
        return html()->a(route('web.admin.footballers.login', $this), '<i class="fal fa-sign-in"></i>')
            ->class('btn btn-info btn-sm')
            ->data('toggle', 'tooltip')
            ->attribute('target', '_blank')
            ->attribute('title', 'Logar como futebolista');
    }

    /**
     * List of headers for the admin listing table.
     *
     * @return array
     */
    public function getExportColumns()
    {
        return ['id', 'name', 'email', 'phone', 'document', 'status', 'created_at'];
    }

    /**
     * Get available ordering fields.
     *
     * @return array
     */
    public function getOrderColumns()
    {
        return ['id', 'name', 'email', 'created_at'];
    }

    /**
     * Get default order key.
     *
     * @return string
     */
    public function getOrderKey()
    {
        return 'id';
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
     * First name attribute.
     *
     * @return mixed
     */
    public function getFirstNameAttribute()
    {
        return $this->firstName();
    }

    /**
     * Last name attribute.
     *
     * @return mixed
     */
    public function getLastNameAttribute()
    {
        return $this->lastName();
    }

    /**
     * First name.
     *
     * @return mixed
     */
    public function firstName()
    {
        $splitName = explode(' ', $this->name);

        return $splitName[0];
    }

    /**
     * Last name.
     *
     * @return mixed
     */
    public function lastName()
    {
        $splitName = explode(' ', $this->name);

        return $splitName[count($splitName) - 1];
    }

    /**
     * Status options.
     *
     * @return Collection
     */
    public static function statusOptions()
    {
        return collect(modelAttribute(self::class, 'options.status'));
    }


     /**
     * Status options.
     *
     * @return Collection
     */
    public static function dominantFootOptions()
    {
        return collect(modelAttribute(self::class, 'options.dominant_foot'));
    }

    /**
     * State options.
     *
     * @return array
     */
    public static function stateOptions()
    {
        return trans('models.default.attributes.options.state');
    }

    /**
     * Send the password reset notification.
     *
     * @param string $token
     *
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetFootballerPasswordNotification($token));
    }

   

    public function getLastLoginAtAttribute()
    {
        $last_log = $this->accessLogs()
            ->first();

        return $last_log ? $last_log->logged_at : null;
    }

    

   

    /**
     * Scope available.
     *
     * @param Builder|Footballer $query
     *
     * @return Builder|Footballer
     */
    public function scopeAvailable($query)
    {
        return $query->where($this->getTable().'.status', self::STATUS_ACTIVE);
    }

    /**
     * Footballer address street.
     *
     * @return string
     */
    public function footballerAddressStreet()
    {
        return data_get($this->address, 'street');
    }

    /**
     * Footballer address number.
     *
     * @return string
     */
    public function footballerAddressNumber()
    {
        return data_get($this->address, 'number');
    }

    /**
     * Footballer address complement.
     *
     * @return string
     */
    public function footballerAddressComplement()
    {
        return data_get($this->address, 'complement');
    }

    /**
     * Footballer address neighborhood.
     *
     * @return string
     */
    public function footballerAddressNeighborhood()
    {
        return data_get($this->address, 'neighborhood');
    }

    /**
     * Footballer address zip code.
     *
     * @return string
     */
    public function footballerAddressZipCode()
    {
        return data_get($this->address, 'zip_code');
    }

    /**
     * Footballer address city.
     *
     * @return string
     */
    public function footballerAddressCity()
    {
        return data_get($this->address, 'city');
    }

    /**
     * Footballer address state.
     *
     * @return string
     */
    public function footballerAddressState()
    {
        return data_get($this->address, 'state');
    }

    /**
     * Footballer address country.
     *
     * @return string
     */
    public function footballerAddressCountry()
    {
        return 'BR';
    }

    public function getAddress()
    {
        $address = collect();

        $street = $this->footballerAddressStreet();
        if (filled($street)) {
            $address->put('street', $street);
        }

        $number = $this->footballerAddressNumber();
        if (filled($number)) {
            $address->put('number', $number);
        }

        $complement = $this->footballerAddressComplement();
        if (filled($complement)) {
            $address->put('complement', $complement);
        }

        $neighborhood = $this->footballerAddressNeighborhood();
        if (filled($neighborhood)) {
            $address->put('neighborhood', $neighborhood);
        }

        $zipCode = $this->footballerAddressZipCode();
        if (filled($zipCode)) {
            $address->put('zipCode', $zipCode);
        }

        $city = $this->footballerAddressCity();
        if (filled($city)) {
            $address->put('city', $city);
        }

        $state = $this->footballerAddressState();
        if (filled($state)) {
            $address->put('state', $state);
        }

        $country = $this->footballerAddressCountry();
        if (filled($country)) {
            $address->put('country', $country);
        }

        return $address;
    }

    public function getCurrentPaymentProfile()
    {
        $profiles = collect();
        if ($this->hide_creditcard) {
            return $profiles;
        }

        $profile = $this->paymentProfiles()
            ->where('is_current', true)
            ->first();

        if (filled($profile)) {
            $profiles->push($profile);
        }

        return $profiles;
    }

    /**
     * Footballer name.
     *
     * @return string
     */
    public function footballerName()
    {
        return $this->name;
    }

    /**
     * Footballer email.
     *
     * @return string
     */
    public function footballerEmail()
    {
        return $this->email;
    }

    /**
     * Footballer document.
     *
     * @return string
     */
    public function footballerDocument()
    {
        return $this->document;
    }

    /**
     * Footballer document.
     *
     * @return string
     */
    public function footballerMobile()
    {
        return $this->phone;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }


}
