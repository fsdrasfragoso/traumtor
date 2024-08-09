<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Libraries\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Activitylog\LogOptions;

/**
 * App\Models\Album
 *
 * @property int $id
 * @property string $type
 * @property string $title
 * @property string $slug
 * @property string|null $summary
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Media[] $media
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Libraries\Database\Eloquent\Model adminOrder($order)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Libraries\Database\Eloquent\Model adminSearch($search)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Libraries\Database\Eloquent\Model filter($filter)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Album onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Album withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Album withoutTrashed()
 * @mixin \Eloquent
 */
class Album extends Model implements HasMedia {

    use InteractsWithMedia,
        SoftDeletes;

    protected $routeFormat = 'web.admin.gallery.{action}';

     /**
     * Register media conversions.
     */
    public function registerMediaConversions(Media $media = null): void
    {

    }
}
