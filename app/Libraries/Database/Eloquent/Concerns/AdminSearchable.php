<?php

namespace App\Libraries\Database\Eloquent\Concerns;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Str;

trait AdminSearchable
{
    /**
     * Executes a search in model fields.
     *
     * @param Builder $query
     * @param array $search
     * @return Builder
     */
    public function scopeAdminSearch($query, $search)
    {
        if (!is_array($search)) {
            return $query;
        }

        foreach ($search as $field => $rules) {
            if (!is_array($rules)) {
                continue;
            }

            foreach ($rules as $method => $value) {
                $method = Str::camel('search-' . $method);

                if ($value === '' || is_null($value) || !method_exists($this, $method)) {
                    continue;
                }

                $this->{$method}($query, $field, $value);
            }
        }

        return $query;
    }

    /**
     * Search field contains the value.
     *
     * @param Builder $query
     * @param string $field
     * @param mixed $value
     * @return Builder
     */
    protected function searchContains($query, $field, $value)
    {
        if (is_array($value)) {
            return $query->where(function ($q) use ($value, $field) {
                foreach ($value as $v) {
                    $q->where($this->fieldName($field), 'like', '%' . $v . '%');
                }

                return $q;
            });
        }

        return $query->where($this->fieldName($field), 'like', '%' . $value . '%');
    }

    protected function searchOrContains($query, $field, $value)
    {
        if (is_array($value)) {
            return $query->where(function ($q) use ($value, $field) {
                foreach ($value as $v) {
                    $q->orWhere($this->fieldName($field), 'like', '%' . $v . '%');
                }

                return $q;
            });
        }

        return $query->orWhere($this->fieldName($field), 'like', '%' . $value . '%');
    }

    /**
     * Search field is equal to the value.
     *
     * @param Builder $query
     * @param string $field
     * @param string $value
     * @return Builder
     */
    protected function searchEquals($query, $field, $value)
    {
        return $query->where($this->fieldName($field), $value);
    }

    /**
     * Search field in in array of values.
     *
     * @param Builder $query
     * @param string $field
     * @param string $value
     * @return Builder
     */
    public function searchIn($query, $field, $value)
    {
        return $query->whereIn($this->fieldName($field), $value);
    }

    /**
     * Search field is null or not.
     *
     * @param Builder $query
     * @param string $field
     * @param string $value
     * @return Builder
     */
    protected function searchNull($query, $field, $value)
    {
        if ($value === 'true') {
            return $query->whereNull($this->fieldName($field));
        } elseif ($value === 'false') {
            return $query->whereNotNull($this->fieldName($field));
        }
    }

    /**
     * Search field date is greater than value.
     *
     * @param Builder $query
     * @param string $field
     * @param string $value
     * @return Builder
     */
    protected function searchGreater($query, $field, $value)
    {
        try {
            $value = Carbon::createFromFormat('d/m/Y', $value);

            return $query->whereDate($this->fieldName($field), '>=', $value);
        } catch (Exception $e) {
        }

        return $query;
    }

    /**
     * Search field date is lesser than value.
     *
     * @param Builder $query
     * @param string $field
     * @param string $value
     * @return Builder
     */
    protected function searchLesser($query, $field, $value)
    {
        try {
            $value = Carbon::createFromFormat('d/m/Y', $value);

            return $query->whereDate($this->fieldName($field), '<=', $value);
        } catch (Exception $e) {
        }

        return $query;
    }

    /**
     * Build field name.
     *
     * @param string $field
     * @return string
     */
    protected function fieldName($field)
    {
        if (strpos($field, '--') !== false) {
            $field = implode('.', explode('--', $field));

            return $field;
        }

        return $this->getTable() . '.' . $field;
    }
}
