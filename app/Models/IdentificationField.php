<?php

namespace App\Models;

use App\Libraries\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IdentificationField extends Model
{
    use SoftDeletes;
}
