<?php

namespace App\Models;

use App\Libraries\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Relations\BelongsToGroupModalitySchedule;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Concerns\WithModalityNameAdminColumn;
use App\Models\FootballMatchPlayers;
use App\Models\Footballer;

class FootballMatch extends Model implements HasMedia
{
    use InteractsWithMedia;
    use LogsActivity;
    use HasFactory;    
    use BelongsToGroupModalitySchedule;
    use WithModalityNameAdminColumn; 

    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

    protected $table = 'football_matches';

    

    /**
     * List of headers for the admin listing table.
     *
     * @return array
     */
    public function getAdminColumns()
    {
        return ['id', 'match_datetime', 'created_at'];
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
        return in_array($attribute, ['match_datetime', 'created_at']);
    }

    /**
     * Get admin order columns.
     *
     * @return array
     */
    public function getOrderColumns()
    {
        return ['id', 'match_datetime', 'created_at'];
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
     * Get FootballMatch model.
     *
     * @return Model
     */
    public function getModel()
    {
        $modelClass = $this->model;

        return new $modelClass;
    }

    /**
     * Get FootballMatch repository.
     *
     * @return Repository
     */
    public function getRepository()
    {
        $repositoryClass = $this->repository;

        return new $repositoryClass($this->model);
    }

   /**
     * Represents a many-to-many relationship between FootballMatch and Footballer.
     *
     * @return BelongsToMany
     */
    public function footballers(): BelongsToMany
    {
        return $this->belongsToMany(Footballer::class, 'football_match_players', 'football_match_id', 'footballer_id')
                    ->withPivot(['is_present', 'id'])
                    ->withTimestamps();
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'football_match_players', 'football_match_id', 'team_id')
                    ->withPivot(['is_present','id'])
                    ->withTimestamps();
    }

    
}
