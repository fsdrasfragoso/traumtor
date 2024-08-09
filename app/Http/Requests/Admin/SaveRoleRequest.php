<?php

namespace App\Http\Requests\Admin;

use App\Models\Role;

class SaveRoleRequest extends CrudRequest
{
    /**
     * Type of class being validated.
     *
     * @var string
     */
    protected $type = Role::class;

    /**
     * Base rules for both creating and editing the resource.
     *
     * @return array
     */
    public function baseRules()
    {
        return [
            'name' => ['required', 'string', 'min:1', 'max:240'],
            'permissions' => ['array'],
            'permissions.*' => ['required', 'exists:permissions,id'],
        ];
    }
}
