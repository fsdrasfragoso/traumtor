<?php

namespace App\Models;

use App\Libraries\Database\Eloquent\Concerns\Fillable;
use App\Libraries\Database\Eloquent\Concerns\HasTranslations;
use App\Libraries\Database\Eloquent\Concerns\Filterable;
use App\Libraries\Database\Eloquent\Concerns\HasColumns;
use App\Libraries\Database\Eloquent\Concerns\HasRoutes;
use App\Libraries\Database\Eloquent\Concerns\AdminOrderable;
use App\Libraries\Database\Eloquent\Concerns\AdminSearchable;
use App\Libraries\Database\Eloquent\Contracts\TableContract;
use App\Models\Concerns\WithIdAdminColumn;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Permission\Models\Role as BaseRole;

/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Footballer[] $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role adminOrder($order)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role adminSearch($search)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role filter($filter)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Spatie\Permission\Models\Role permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Role extends BaseRole implements TableContract
{
    use Fillable,
        Filterable,
        HasColumns,
        HasRoutes,
        HasTranslations,
        LogsActivity,
        AdminOrderable,
        AdminSearchable,
        WithIdAdminColumn;

    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

    /**
     * List of headers for the admin listing table.
     *
     * @return array
     */
    public function getAdminColumns()
    {
        return ['id', 'name', 'users', 'created_at'];
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
        return in_array($attribute, ['name']);
    }

    /**
     * Get users count admin column.
     *
     * @return int
     */
    public function getUsersAdminColumn()
    {
        return $this->users()->count();
    }

    /**
     * Get admin order columns
     *
     * @return array
     */
    public function getOrderColumns()
    {
        return ['id', 'name', 'created_at'];
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

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults();
    }
}
