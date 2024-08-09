<?php

namespace App\Http\Requests\Frontend\Auth;

use App\Http\Requests\FormRequest;
use App\Models\Footballer;
use Illuminate\Support\Facades\Hash;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Type of class being validated.
     *
     * @var string
     */
    protected $type = Footballer::class;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => ['required', 'min:6', function($attribute, $value, $fail) {
                $footballer = footballer();

                if(!Hash::check($value, $footballer->password)) {
                    $fail('Senha atual está incorreta.');
                }
            }],
            'password' => ['required', 'min:8', 'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/'],
            'password_confirmation' => ['required', 'same:password'],
        ];
    }
}
