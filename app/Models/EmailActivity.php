<?php

namespace App\Models;

use App\Libraries\Database\Eloquent\Model;
use App\Models\Relations\BelongsToEmail;

class EmailActivity extends Model {

    use BelongsToEmail;

    public const ACTIVITY_BOUNCE = 'bounce';
    public const ACTIVITY_COMPLAINT = 'complaint';
    public const ACTIVITY_DELIVERY = 'delivery';
    public const ACTIVITY_SEND = 'send';
}
