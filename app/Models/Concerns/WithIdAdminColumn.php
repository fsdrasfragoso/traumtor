<?php

namespace App\Models\Concerns;

trait WithIdAdminColumn {

    /**
     * Get id admin column
     *
     * @param bool $export
     * @return mixed|string
     */
    public function getIdAdminColumn($export = false)
    {
        if($export) {
            return $this->getKey();
        }

        $user = user();

        if($user && $user->can('view', $this)) {
            $link = $this->route('show');
        }

        if((!isset($link) || !$link) && $user && $user->can('update', $this)) {
            $link = $this->route('edit');
        }

        if(isset($link)) {
            return html()->a($link, '#'.$this->getKey())->data('pjax', true);
        }

        return '#'.$this->getKey();
    }
}