<?php

namespace App\Services;

use App\Models\Footballer;
use App\Repositories\FootballerAccessLogRepository;
use Carbon\Carbon;

class FootballerAccessLogService
{
    /**
     * Log a footballer access.
     *
     * @param string $ip_address
     *
     * @return void
     */
    public function logAccess(Footballer $footballer, $ip_address = null)
    {
        $attributes = [
            'footballer_id' => $footballer->id,
            'ip_address' => $ip_address,
            'logged_at' => Carbon::now(),
        ];

        return (new FootballerAccessLogRepository())->create($attributes);
    }

    /**
     * Log a footballer app access.
     *
     * @param string $ip_address
     *
     * @return void
     */
    public function logAppAccess(Footballer $footballer)
    {
        if ($footballer->app_downloaded_at) {
            return false;
        }

        $footballer->app_downloaded_at = now();
        $footballer->save();

        return true;
    }
}
