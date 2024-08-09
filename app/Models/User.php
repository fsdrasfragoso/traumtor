<?php

namespace App\Models;

use App\Libraries\Database\Eloquent\Model;
use App\Models\Concerns\WithIdAdminColumn;
use App\Models\Relations\MorphManyEmails;
use App\Notifications\ResetUserPasswordNotification;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Passport\HasApiTokens;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract, JWTSubject
{
    use Authenticatable;
    use Authorizable;
    use CanResetPassword;
    use HasApiTokens;
    use HasRoles;
    use LogsActivity;
    use MorphManyEmails;
    use Notifiable;
    use SoftDeletes;
    use WithIdAdminColumn;
    use HasFactory;

    const SUPER_ADMIN_ROLE_NAME = 'Administrador';

    /**
     * Guard name for role permissions.
     *
     * @var string
     */
    protected $guard_name = 'users';

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
        return ['id', 'name', 'email', 'roles', 'created_at'];
    }

    /**
     * Get roles admin column
     *
     * @param bool $export
     * @return string
     */
    public function getRolesAdminColumn($export = false)
    {
        return $this->roles->pluck('name')->join(', ');
    }

    /**
     * If this column should expand.
     *
     * @param int $index
     * @param string $attribute
     *
     * @return bool
     */
    public function getAdminColumnExpand($index, $attribute)
    {
        return in_array($attribute, ['name', 'email']);
    }

    /**
     * Get admin order columns.
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
        return 'name';
    }

    /**
     * Get default order direction.
     *
     * @return string
     */
    public function getOrderDir()
    {
        return 'asc';
    }

    /**
     * Send the password reset notification.
     *
     * @param string $token
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetUserPasswordNotification($token));
    }

    public function isSuper()
    {
        return $this->hasRole(self::SUPER_ADMIN_ROLE_NAME);
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
