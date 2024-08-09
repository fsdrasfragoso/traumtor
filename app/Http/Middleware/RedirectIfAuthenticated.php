<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    { 
        if (Auth::guard($guard)->check()) {

            if($guard == 'users') {
                return redirect(route('web.admin.default.show'));
            } else if($guard == 'footballers') {
                return redirect(route('web.frontend.default.index'));
            }

            return redirect('/');
        }

        return $next($request);
    }
}
