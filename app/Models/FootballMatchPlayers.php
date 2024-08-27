<?php

namespace App\Models;

use App\Libraries\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FootballMatchPlayers extends Model
{
    use LogsActivity;
    use HasFactory;

    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

    protected $table = 'football_match_players';

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'football_match_id',
        'footballer_id',
        'is_present',
    ];

    /**
     * Define a relação com o modelo FootballMatch.
     *
     * @return BelongsTo
     */
    public function footballMatch(): BelongsTo
    {
        return $this->belongsTo(FootballMatch::class, 'football_match_id');
    }

    /**
     * Define a relação com o modelo Footballer.
     *
     * @return BelongsTo
     */
    public function footballer(): BelongsTo
    {
        return $this->belongsTo(Footballer::class, 'footballer_id');
    }

    /**
     * List of headers for the admin listing table.
     *
     * @return array
     */
    public function getAdminColumns()
    {
        return ['id', 'football_match_id', 'footballer_id', 'is_present', 'created_at'];
    }

    /**
     * Get admin order columns.
     *
     * @return array
     */
    public function getOrderColumns()
    {
        return ['id', 'football_match_id', 'footballer_id', 'is_present', 'created_at'];
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
}
