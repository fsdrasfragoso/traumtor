<?php

namespace App\Models\Concerns;

trait WithResponseAdminColumn {

    /**
     * Get response admin column
     *
     * @return string
     */
    public function getResponseAdminColumn()
    {
        $html = '';

        if($this->response) {
            $html .= '<a href="#data-'.$this->id.'" data-toggle="modal">Ver Resposta</a>';
            $html .= '<div id="data-'.$this->id.'" class="modal fade" tabindex="-1" role="dialog">';
            $html .= '<div class="modal-dialog">';
            $html .= '<div class="modal-content">';
            $html .= '<div class="modal-header">';
            $html .= '<h5 class="modal-title">Resposta</h5>';
            $html .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
            $html .= '</div>';
            $html .= '<div class="modal-body">';
            $html .= '<pre><code class="json">'.json_encode($this->response,
                    JSON_PRETTY_PRINT).'</code></pre>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
        }

        return $html;
    }
}