<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Frontend\Concerns\ThrottlesRequests;
use App\Http\Requests\Frontend\Auth\RegisterRequest;
use App\Models\Footballer;
use App\Http\Controllers\Controller;
use App\Services\FootballerService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\View\View;

class RegisterController extends Controller
{
    use ThrottlesRequests;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:footballers');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('frontend.auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $request = new RegisterRequest();
        return Validator::make($data, $request->rules(), $request->messages());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $params
     * @return Footballer
     */
    protected function create(array $params)
    {
        $footballer = (new FootballerService())->register($params);

        $this->guard()->login($footballer);

        return $footballer;
    }

    /**
     * Register
     *
     * @param Request $request
     */
    public function register(Request $request)
    {
        $this->incrementRequestAttempts($request, 'register');

        $this->validator($request->all())->validate();

        $params = array_merge($request->all(), [
            'ip_address_in_register' => $request->ip()
        ]);

        event(new Registered($footballer = $this->create($params)));

        return $this->registered($request, $footballer)
                        ?: redirect($this->redirectPath());
    }


    /**
     * Validate form request for javascript.
     *
     * @return Request
     */
    public function validation()
    {
        return app(RegisterRequest::class)
            ? response()->json(['status' => 'valid'])
            : response()->json(['status' => 'invalid'], 422);
    }

    /**
     * The user has been registered.
     *
     * @param  Request $request
     * @param  mixed $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        if($request->input('redirect_url')) {
            return redirect($request->input('redirect_url'));
        }

        return redirect()
            ->route('web.frontend.default.index')
            ->with('success', 'Seu cadastrado foi realizado com sucesso!');
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('footballers');
    }
}
