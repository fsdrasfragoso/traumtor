<?php

namespace App\Libraries\Database\Eloquent\Concerns;

trait HasTranslations
{
    /**
     * Get translation by key.
     *
     * @param string $key
     * @return string
     */
    public function trans($key)
    {
        return __t(
            'models.'.get_class($this).'.actions.' . $key,
            'models.default.actions.' . $key
        );
    }
}
