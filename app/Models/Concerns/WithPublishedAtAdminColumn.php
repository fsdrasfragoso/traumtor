<?php

namespace App\Models\Concerns;

trait WithPublishedAtAdminColumn
{

    /**
     * Get published at admin column
     *
     * @param bool $export
     * @return string
     */
    public function getPublishedAtAdminColumn($export = false)
    {
        if ($export) {
            return $this->published_at->format(config('admin.timestamp_format'));
        }

        $html = '';

        if ($this->published_at) {
            $html .= $this->published_at->format(config('admin.timestamp_format'));
        }

        if ($this->unpublished_at) {
            if ($html) {
                $html .= '<br>';
            }

            $html .= '<span class="text-danger">' . $this->unpublished_at->format(config('admin.timestamp_format')) . '</span>';
        }

        return $html;
    }
}
