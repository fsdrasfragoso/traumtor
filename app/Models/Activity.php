<?php

namespace App\Models;

use App\Http\Controllers\Admin\Concerns\HasViews;
use App\Libraries\Database\Eloquent\Concerns\HasTranslations;
use App\Libraries\Database\Eloquent\Concerns\Filterable;
use App\Libraries\Database\Eloquent\Concerns\HasColumns;
use App\Libraries\Database\Eloquent\Concerns\HasRoutes;
use App\Libraries\Database\Eloquent\Concerns\AdminOrderable;
use App\Libraries\Database\Eloquent\Concerns\AdminSearchable;
use App\Libraries\Database\Eloquent\Contracts\TableContract;
use App\Models\Concerns\WithIdAdminColumn;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;
use \Spatie\Activitylog\Models\Activity as BaseActivity;

class Activity extends BaseActivity implements TableContract
{
    use AdminOrderable;
    use AdminSearchable;
    use Filterable;
    use HasColumns;
    use HasRoutes;
    use HasTranslations;
    use WithIdAdminColumn;

    public function causer(): MorphTo
    {
        if (config('activitylog.causer_returns_soft_deleted_models')) {
            return $this->morphTo()->withTrashed();
        }

        return $this->morphTo();
    }

    /**
     * List of headers for the admin listing table.
     *
     * @return array
     */
    public function getAdminColumns()
    {
        return ['id', 'causer', 'object', 'action', 'properties', 'created_at'];
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
        return in_array($attribute, ['action']);
    }

    /**
     * Get causer admin column
     *
     * @return mixed|string
     */
    public function getCauserAdminColumn()
    {
        $causer = $this->causer;
        return $causer ? $causer->name : 'Sistema';
    }

    /**
     * Get object admin column
     *
     * @return string
     */
    public function getObjectAdminColumn()
    {
        $html = '';
        if (is_null($this->subject)) {
            $html .= modelAction($this->subject_type, 'label');
        } elseif (Route::has('web.admin.' . $this->subject->getTable() . '.show')) {
            $html .= html()->a(
                route('web.admin.' . $this->subject->getTable() . '.show', [$this->subject]),
                modelAction(get_class($this->subject), 'label') . ' #' . $this->subject_id
            );
        } elseif (Route::has('web.admin.' . $this->subject->getTable() . '.edit')) {
            $html .= html()->a(route('web.admin.' . $this->subject->getTable() . '.edit', [$this->subject]), modelAction(get_class($this->subject), 'label') . ' #' . $this->subject_id);
        } else {
            $html .= modelAction(get_class($this->subject), 'label') . ' #' . $this->subject_id;
        }

        return $html;
    }

    /**
     * Get action admin column
     *
     * @return array|\Illuminate\Contracts\Translation\Translator|null|string
     */
    public function getActionAdminColumn()
    {
        if (Lang::has("models.{$this->subject_type}.actions.success.{$this->description}")) {
            return trans("models.{$this->subject_type}.actions.success.{$this->description}");
        } elseif (Lang::has("models.default.actions.success.{$this->description}")) {
            return trans("models.default.actions.success.{$this->description}");
        } else {
            return $this->description;
        }
    }

    /**
     * Get subject type options
     *
     * @return array
     */
    public function subjectTypeOptions()
    {
        $appNamespace = \Illuminate\Container\Container::getInstance()->getNamespace();
        $modelNamespace = 'Models';

        $models = collect(File::allFiles(app_path($modelNamespace)))->map(function ($item) use ($appNamespace, $modelNamespace) {
            $rel   = $item->getRelativePathName();
            $class = sprintf(
                '%s%s%s',
                $appNamespace,
                $modelNamespace ? $modelNamespace . '\\' : '',
                implode('\\', explode('/', substr($rel, 0, strrpos($rel, '.'))))
            );
            return class_exists($class) ? $class : null;
        })->filter();

        $options = [];

        foreach ($models as $model) {

            $key = 'models.' . $model . '.actions.label';
            if (Lang::has($key)) {
                $options[$model] = trans($key);
            }
        }

        asort($options);

        return $options;
    }

    public function actionOptions()
    {
        return modelAttribute(self::class, 'options.action');
    }

    /**
     * Get route name by action.
     *
     * @param string $action
     * @return mixed
     */
    protected function routeName($action)
    {
        $name = str_replace(
            ['{action}', '{table}'],
            [$action, 'activities'],
            $this->routeFormat
        );

        return $name;
    }
}
