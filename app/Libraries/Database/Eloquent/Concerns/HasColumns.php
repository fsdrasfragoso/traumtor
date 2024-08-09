<?php

namespace App\Libraries\Database\Eloquent\Concerns;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Spatie\Html\Attributes;

trait HasColumns
{
    /**
     * List of headers for the admin listing table.
     *
     * @return array
     */
    public function getAdminColumns()
    {
        return [$this->getKey()];
    }

    /**
     * List of export columns.
     *
     * @return array
     */
    public function getExportColumns()
    {
        return $this->getAdminColumns();
    }

    /**
     * Convert date to localized format.
     *
     * @param string $attribute
     * @param bool $export
     * @return string
     */
    public function getDateAdminColumn($attribute, $export = false)
    {
        $value = $this->{$attribute};

        if (is_null($value)) {
            return '';
        }

        if (is_string($value)) {
            $value = $this->asDateTime($value);
        }

        return $value->format(config('admin.date_format'));
    }

    /**
     * Value for an admin column.
     *
     * @param string $attribute
     * @param bool $export
     * @return string
     */
    public function getAdminColumn($attribute, $export = false)
    {
        $attribute = str_replace('.', '-', $attribute);

        if(substr($attribute, -2) === '__') {
            $attribute = substr($attribute, 0, -2);
        }

        $method = Str::camel('get-'.$attribute.'-admin-column');
        if (method_exists($this, $method)) {
            return $this->{$method}($export);
        }

        if ($this->hasAdminColumnView($attribute)) {
            return $this->getAdminColumnView($attribute)
                ->with('instance', $this);
        }

        if ($this->isDateAttribute($attribute)) {
            return $this->getDateAdminColumn($attribute, $export);
        }

        return $this->$attribute;
    }

    public function getAdminColumnView($column)
    {
        return view($this->getAdminColumnViewPath($column));
    }

    public function hasAdminColumnView($column)
    {
        return View::exists($this->getAdminColumnViewPath($column));
    }

    public function getAdminColumnViewPath($column)
    {
        $className = class_basename($this);
        $module = strtolower(Str::plural(Str::snake($className)));
        return "admin.{$module}.partials.columns.{$column}";
    }

    /**
     * Get admin row class.
     *
     * @param $index
     * @return string
     */
    public function getAdminRowClass($index)
    {
        return '';
    }

    public function getAdminRowAttributes($index)
    {
        $attributes = new Attributes();
        $attributes->addClass($this->getAdminRowClass($index));
        return $attributes->render();
    }

    /**
     * Get admin column class.
     *
     * @param $index
     * @param $attribute
     * @return string
     */
    public function getAdminColumnClass($index, $attribute)
    {
        $classes = collect([]);

        if (!$this->getAdminColumnExpand($index, $attribute)) {
            $classes->push('shrink');
        }

        $method = camel_case('get-'.$attribute.'-admin-column-class');

        if (method_exists($this, $method)) {
            $classes->push($this->{$method}());
        }

        return $classes->implode(' ');
    }

    public function getAdminColumnAttributes($index, $attribute)
    {
        $attributes = new Attributes();

        $method = camel_case('get-'.$attribute.'-admin-column-attributes');
        if (method_exists($this, $method)) {
            $attributes->setAttributes($this->{$method}());
        }

        $attributes->addClass($this->getAdminColumnClass($index, $attribute));

        return $attributes->render();
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
        return $index === (count($this->getAdminColumns()) - 1);
    }

    /**
     * Get admin actions.
     *
     * @return string
     */
    public function getAdminActions()
    {
        if ($this->hasAdminColumnView('actions')) {
            return $this->getAdminColumnView('actions')
                ->with('instance', $this);
        }
    }

    /**
     * Get admin dropdown actions.
     *
     * @return string
     */
    public function getAdminDropdownActions()
    {
    }
}
