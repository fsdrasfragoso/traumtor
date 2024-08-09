<?php

namespace App\Models;

use App\Libraries\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use function App\Helper\settings;

class Setting extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['meta_key', 'meta_value'];

    /**
     * Easy cast settings.
     *
     * @var array
     */
    public $easyCast = [];

    /**
     * Get settings attribute as a settings object.
     *
     * @return mixed
     */
    public function getMetaValueAttribute()
    {
        $settings = unserialize(data_get($this->attributes, 'meta_value'));

        return $settings;
    }

    /**
     * Set settings attribute as a json string.
     *
     * @param mixed $value
     * @return string
     */
    public function setMetaValueAttribute($value)
    {
        $settings = serialize($value);

        return data_set($this->attributes, 'meta_value', $settings);
    }
}
