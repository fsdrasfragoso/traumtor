<?php

namespace App\Models;

use App\Libraries\Database\Eloquent\Model;
use App\Models\Concerns\WithIdAdminColumn;
use App\Models\Concerns\WithStatusAdminColumn;
use App\Models\Concerns\WithUsersNameAdminColumn;
use App\Models\Relations\BelongsToUser;
use App\Repositories\Repository;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Export extends Model implements HasMedia
{
    use InteractsWithMedia;
    use LogsActivity;
    use WithIdAdminColumn;
    use WithUsersNameAdminColumn;
    use WithStatusAdminColumn;
    use BelongsToUser;
    use HasFactory;

    const STATUS_CREATED = 'created';
    const STATUS_PENDING = 'pending';
    const STATUS_SUCCESS = 'success';
    const STATUS_FAILED = 'failed';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'parameters' => 'json',
    ];

    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

    /**
     * List of headers for the admin listing table.
     *
     * @return array
     */
    public function getAdminColumns()
    {
        return ['id', 'title', 'size', 'model', 'users--name', 'status', 'created_at'];
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
        return in_array($attribute, ['title', 'users--name']);
    }

    /**
     * Get title admin column.
     *
     * @return string
     */
    public function getTitleAdminColumn()
    {
        return $this->buildFileName();
    }

    public function getSizeAdminColumn()
    {
        $media = $this->getFirstMedia('csv');
        if (empty($media)) {
            return '0 KB';
        }
        return $media->getHumanReadableSizeAttribute();
    }

    /**
     * Get admin order columns.
     *
     * @return array
     */
    public function getOrderColumns()
    {
        return ['id', 'title', 'users--name', 'status', 'created_at'];
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
     * Get export model.
     *
     * @return Model
     */
    public function getModel()
    {
        $modelClass = $this->model;

        return new $modelClass;
    }

    /**
     * Get export repository.
     *
     * @return Repository
     */
    public function getRepository()
    {
        $repositoryClass = $this->repository;

        return new $repositoryClass($this->model);
    }

    /**
     * Build file name.
     *
     * @return string
     */
    public function buildFileName()
    {
        return $this->getModel()
                ->getTable().'_export_'.$this->id.'_user_'.$this->user_id.'_'.$this->created_at->format('YmdHis');
    }
}
