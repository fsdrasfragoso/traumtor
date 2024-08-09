<?php

namespace App\Repositories\Concerns;

trait WithSelectOptions
{
    /**
     * Returns the resource main column.
     *
     * @return string
     */
    abstract public function getResourceLabel();

    /**
     * Return the resource key.
     *
     * @return mixed
     */
    public function getResourceKeyName()
    {
        return $this->getInstance()->getKeyName();
    }

    /**
     * Returns an associative array with the main column of the resource.
     *
     * @return mixed
     */
    public function selectOptions()
    {
        return $this->newQuery()
            ->orderBy($this->getResourceLabel())
            ->pluck(
                $this->getResourceLabel(),
                $this->getResourceKeyName()
            );
    }
}
