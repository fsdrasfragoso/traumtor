<?php

namespace App\Libraries\Database\Eloquent\Concerns;

trait WithDefaultActions
{
    /**
     * Get default enabled.
     *
     * @param string $key
     * @return string
     */
    public function withDefaultActions()
    {
        return true;
    }
}
