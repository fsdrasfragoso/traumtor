<?php

namespace App\Http\Requests\Admin;

use App\Models\Setting;

class SaveSettingBlocksRequest extends CrudRequest
{
    /**
     * Type of class being validated.
     *
     * @var string
     */
    protected $type = Setting::class;

    /**
     * Base rules for both creating and editing the resource.
     *
     * @return array
     */
    public function baseRules()
    {
        return [
            'blocks' => [],
        ];
    }
}
