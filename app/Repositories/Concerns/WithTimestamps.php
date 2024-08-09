<?php

namespace App\Repositories\Concerns;

use Carbon\Carbon;

trait WithTimestamps
{
    /**
     * Filter timestamp attributes.
     *
     * @param array $attributes
     * @return array
     */
    protected function filterTimestampAttributes($attributes, $names)
    {
        foreach ($names as $name) {
            if ($value = data_get($attributes, $name)) {
                $attributes[$name] = Carbon::createFromFormat(config('admin.timestamp_format'), $value);
            }
        }

        return $attributes;
    }
}
