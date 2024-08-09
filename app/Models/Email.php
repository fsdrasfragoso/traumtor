<?php

namespace App\Models;

use App\Libraries\Database\Eloquent\Concerns\HasColumns;
use App\Libraries\Database\Eloquent\Model;
use App\Models\Relations\MorphToReference;
use App\Models\Concerns\WithIdAdminColumn;
use App\Models\Relations\HasManyEmailActivities;

class Email extends Model {

    use HasManyEmailActivities;
    use MorphToReference;

    public const TYPE_PASSWORD_RECOVERY = 'password_recovery';
    public const TYPE_WELCOME = 'welcome';

    public const STATUS_DELIVERED = 'delivered';
    public const STATUS_REJECTED = 'rejected';
    public const STATUS_SENT = 'sent';
}
