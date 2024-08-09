<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Show the form for editing current user
     *
     * @return View
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit()
    {
        $instance = user();

        return view('admin.auth.user')
            ->with('instance', $instance)
            ->with('type', User::class);
    }

    /**
     * Update the current user.
     *
     * @return RedirectResponse
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request)
    {
        /** @var User $instance */
        $instance = user();

        $this->validate($request, [
            'email' => ['unique:users,email,'.$instance->getKey()],
            'password' => $request->input('password') ? ['required', 'min:8'] : [],
            'password_confirmation' => $request->input('password') ? ['required', 'same:password'] : [],
        ]);

        $instance->name = $request->input('name');
        $instance->email = $request->input('email');

        if($request->input('password')) {
            $instance->password = bcrypt($request->input('password'));
        }

        $instance->save();

        return back()->with(
            'success',
            modelAction(User::class, 'success.updated')
        );
    }
}
