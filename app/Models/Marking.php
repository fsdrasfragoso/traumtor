<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Libraries\Database\Eloquent\Model as BaseModel;
use App\Repositories\Repository;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Relations\BelongsToModality;

class Marking extends BaseModel implements HasMedia
{
    use InteractsWithMedia;
    use LogsActivity;
    use HasFactory;
    use BelongsToModality;

    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

    protected $fillable = [
        'name',
        'description',
        'advantages',
        'disadvantages',
        'modality_id',
    ];

    /**
     * List of headers for the admin listing table.
     *
     * @return array
     */
    public function getAdminColumns()
    {
        return ['id', 'name', 'description', 'advantages', 'disadvantages', 'modality--name'];
    }
}
