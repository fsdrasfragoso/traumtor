<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Auth\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChangePasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:footballers');
    }

    /**
     * Change password
     *
     * @param ChangePasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function change(ChangePasswordRequest $request)
    {
        $footballer = footballer();

        $password = bcrypt($request->input('password'));

        $footballer->password = $password;
        $footballer->save();

        return back()
            ->with('success', 'Sua senha foi alterada com sucesso!');
    }
}
