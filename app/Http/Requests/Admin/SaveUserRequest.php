<?php

namespace App\Http\Requests\Admin;

use App\Models\User;

class SaveUserRequest extends CrudRequest
{
    /**
     * Type of class being validated.
     *
     * @var string
     */
    protected $type = User::class;

    /**
     * Rules when editing resource.
     *
     * @return array
     */
    protected function editRules()
    {
        return [
            'email' => ['unique:users,email,'.$this->route('id')],
            'code' => [],
            'password' => $this->input('password') ? ['required', 'min:8'] : [],
            'password_confirmation' => $this->input('password') ? ['required', 'same:password'] : [],
        ];
    }

    /**
     * Rules when creating resource.
     *
     * @return array
     */
    protected function createRules()
    {
        return [
            'email' => ['unique:users,email'],
            'code' => [],
            'password' => ['required', 'min:8'],
            'password_confirmation' => ['required', 'same:password'],
        ];
    }

    /**
     * Base rules for both creating and editing the resource.
     *
     * @return array
     */
    public function baseRules()
    {
        return [
            'name' => ['required', 'string', 'min:1', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'code' => [],
            'roles' => ['array'],
            'roles.*' => ['required', 'exists:roles,id'],
        ];
    }
}
