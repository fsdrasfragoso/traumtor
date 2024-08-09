<?php

namespace App\Models\Concerns;

trait WithTitleAdminColumn {

    /**
     * Get title admin column
     *
     * @param bool $export
     * @return mixed|string
     */
    public function getTitleAdminColumn($export = false)
    {
        if($export) {
            return $this->title;
        }

        $html = $this->title;

        if($this->slug) {
            $html .= '<br><code>' . $this->slug . '</code>';
        }

        if($this->code) {
            $html .= '<br><span class="badge badge-secondary">' . $this->code . '</span>';
        }

        return $html;
    }
}