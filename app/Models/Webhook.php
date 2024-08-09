<?php

namespace App\Models;

use App\Libraries\Database\Eloquent\Model;
use App\Models\Concerns\WithIdAdminColumn;
use App\Models\Concerns\WithPaymentGateway;
use App\Models\Concerns\WithPaymentGatewayAdminColumn;

class Webhook extends Model
{
    use WithIdAdminColumn,
        WithPaymentGatewayAdminColumn,
        WithPaymentGateway;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'json',
    ];

    /**
     * List of headers for the admin listing table.
     *
     * @return array
     */
    public function getAdminColumns()
    {
        return ['id', 'payment_gateway', 'type', 'reference', 'data', 'processed', 'created_at'];
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
        return in_array($attribute, ['data']);
    }

    /**
     * Get admin row class
     *
     * @param $index
     * @return string
     */
    public function getAdminRowClass($index)
    {
        if($this->manual) {
            return 'table-info';
        }
    }

    /**
     * Get reference admin column
     *
     * @return string
     */
    public function getReferenceAdminColumn()
    {
        return $this->reference_type.':'.$this->reference_id;
    }

    /**
     * Get data admin column
     *
     * @return string
     */
    public function getDataAdminColumn()
    {
        $html = '<a href="#data-'.$this->id.'" data-toggle="collapse">Checksum: '.$this->checksum.'</a>';
        $html .= '<pre id="data-'.$this->id.'" class="collapse"><code class="json">'.json_encode($this->data,
                JSON_PRETTY_PRINT).'</code></pre>';

        return $html;
    }

    /**
     * Get processed admin column
     *
     * @return string
     */
    public function getProcessedAdminColumn()
    {
        $html = '<span class="badge badge-'.($this->processed ? 'success' : 'danger').'">'.modelAttribute(self::class,
                'options.boolean.'.intval($this->processed)).'</span>';

        if($this->manual) {
            $html .= ' <span class="badge badge-info">Manual</span>';
        }

        return $html;
    }

    /**
     * Get available ordering fields.
     *
     * @return array
     */
    public function getOrderColumns()
    {
        return ['id', 'created_at'];
    }

    /**
     * Get default order key.
     *
     * @return string
     */
    public function getOrderKey()
    {
        return 'id';
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
}
