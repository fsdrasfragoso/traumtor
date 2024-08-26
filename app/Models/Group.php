<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Libraries\Database\Eloquent\Model;
use App\Models\Relations\BelongsToManyFootballer;
use App\Models\Concerns\WithFootballersAdminColumn;
use App\Models\Concerns\WithModalityNameAdminColumn;
use App\Models\Concerns\WithCaptainNameAdminColumn;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;

class Group extends Model implements HasMedia
{
    use InteractsWithMedia;
    use LogsActivity;
    use HasFactory;
    use BelongsToManyFootballer;
    use WithFootballersAdminColumn;
    use WithModalityNameAdminColumn; 
    use WithCaptainNameAdminColumn;
    use SoftDeletes;

    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;     
   

    

    /**
     * List of headers for the admin listing table.
     *
     * @return array
     */
    public function getAdminColumns()
    {
        return ['id', 'name', 'description', 'captain--name', 'footballers'];
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
        return in_array($attribute, ['name', 'created_at']);
    }

    /**
     * Get admin order columns.
     *
     * @return array
     */
    public function getOrderColumns()
    {
        return ['id', 'name', 'modality_id', 'created_at'];
    }

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
     * Get Position model.
     *
     * @return Model
     */
    public function getModel()
    {
        $modelClass = $this->model;

        return new $modelClass;
    }

    /**
     * Get Position repository.
     *
     * @return Repository
     */
    public function getRepository()
    {
        $repositoryClass = $this->repository;

        return new $repositoryClass($this->model);
    }

    /**
     * Represents a many-to-many relationship between groups and footballers.
     *
     * @return BelongsToMany
     */
    public function footballers(): BelongsToMany
    {
        return $this->belongsToMany(Footballer::class, 'group_footballer');
    }

    /**
     * Represents a one-to-one relationship between a group and its captain.
     *
     * @return BelongsTo
     */
    public function captain(): BelongsTo
    {
        return $this->belongsTo(Footballer::class, 'captain_id');
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
     * State options.
     *
     * @return array
     */
    public static function dayOptions()
    {
        return trans('models.default.attributes.options.day');
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(GroupModalitySchedule::class, 'group_id');
    }

     
}
