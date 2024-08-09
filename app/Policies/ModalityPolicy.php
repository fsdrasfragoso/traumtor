<?php

namespace App\Policies;

use App\Policies\Concerns\ChangeResource;
use App\Policies\Concerns\CreateResource;
use App\Policies\Concerns\ExportResource;
use App\Policies\Concerns\ListResource;
use App\Policies\Concerns\ManageResource;
use App\Policies\Concerns\UpdateResource;
use App\Policies\Concerns\ViewResource;
use App\Policies\Concerns\RollbackResource;
use App\Policies\Concerns\AuditResource;
use App\Policies\Concerns\RejectResource;
use App\Policies\Concerns\ApproveResource;
use App\Policies\Concerns\DeleteResource;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModalityPolicy
{
    use HandlesAuthorization;
    use ManageResource;
    use ListResource;
    use CreateResource;
    use UpdateResource;
    use ViewResource;
    use ChangeResource;
    use ExportResource;
    use RollbackResource;
    use AuditResource;
    use RejectResource;
    use ApproveResource;
    use DeleteResource;
    
    protected $resource = 'modalities';
}
