<?php

namespace App\Models\Concerns;

trait WithUsersNameAdminColumn {

    /**
     * Get users name admin column
     *
     * @param bool $export
     * @return mixed|string
     */
    public function getUsersNameAdminColumn($export = false)
    {
        if($this->user) {
            if ($export) {
                return $this->user->name;
            }

            return html()->a(route('web.admin.users.edit', $this->user), $this->user->name)->data('pjax', true);
        }

        return null;
    }
}