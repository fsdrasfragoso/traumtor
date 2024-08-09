<?php

namespace App\Libraries\Database\Eloquent;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Libraries\Database\Eloquent\Concerns\Fillable;
use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Libraries\Database\Eloquent\Concerns\HasTranslations;
use App\Libraries\Database\Eloquent\Concerns\HasColumns;
use App\Libraries\Database\Eloquent\Concerns\HasRoutes;
use App\Libraries\Database\Eloquent\Concerns\Filterable;
use App\Libraries\Database\Eloquent\Concerns\AdminOrderable;
use App\Libraries\Database\Eloquent\Concerns\AdminSearchable;
use App\Libraries\Database\Eloquent\Contracts\TableContract;
use App\Libraries\Database\Eloquent\Concerns\ArrayFilterable;
use App\Libraries\Database\Eloquent\Concerns\WithDefaultActions;

abstract class Model extends Eloquent implements TableContract
{
    use LogsActivity;
    use ArrayFilterable;
    use AdminOrderable;
    use AdminSearchable;
    use Fillable;
    use Filterable;
    use HasColumns;
    use HasRoutes;
    use HasTranslations;
    use WithDefaultActions;

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults();
    }
}
