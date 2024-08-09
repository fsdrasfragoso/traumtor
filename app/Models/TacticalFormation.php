<?php

namespace App\Models;

use App\Libraries\Database\Eloquent\Model;
use App\Repositories\Repository;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Relations\BelongsToModality;
use App\Models\Concerns\WithModalityNameAdminColumn;

class TacticalFormation extends Model implements HasMedia
{
    use InteractsWithMedia;
    use LogsActivity;
    use HasFactory;
    use BelongsToModality;
    use WithModalityNameAdminColumn;

    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

    /**
     * List of headers for the admin listing table.
     *
     * @return array
     */
    public function getAdminColumns()
    {
        return ['id', 'name', 'description', 'modality--name'];
    }

    /**
     * If this column should expand.
     *
     * @param int $index
     * @param string $attribute
     * @return bool
     */
    public function getAdminColumnExpand($index, $attribute)
    {
        return in_array($attribute, ['name', 'created_at']);
    }

    /**
     * Get admin order columns.
     *
     * @return array
     */
    public function getOrderColumns()
    {
        return ['id', 'name', 'modality_id', 'created_at'];
    }

    /**
     * Get default order key.
     *
     * @return string
     */
    public function getOrderKey()
    {
        return 'created_at';
    }

    /**
     * Get default order direction.
     *
     * @return string
     */
    public function getOrderDir()
    {
        return 'desc';
    }

    /**
     * Get TacticalFormation model.
     *
     * @return Model
     */
    public function getModel()
    {
        $modelClass = $this->model;

        return new $modelClass;
    }

    /**
     * Get TacticalFormation repository.
     *
     * @return Repository
     */
    public function getRepository()
    {
        $repositoryClass = $this->repository;

        return new $repositoryClass($this->model);
    }
}
