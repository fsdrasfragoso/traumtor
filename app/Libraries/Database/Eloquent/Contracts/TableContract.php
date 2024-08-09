<?php

namespace App\Libraries\Database\Eloquent\Contracts;

interface TableContract
{
    /**
     * List of headers for the admin listing table.
     *
     * @return array
     */
    public function getAdminColumns();
}
