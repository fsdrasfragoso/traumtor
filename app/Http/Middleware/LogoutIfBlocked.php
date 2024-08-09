<?php

namespace App\Http\Middleware;

use App\Models\Footballer;
use Closure;

class LogoutIfBlocked
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->hasFootballerLoggedIn()) {
            auth('footballers')->logout();

            return redirect()
                ->route('web.frontend.default.index')
                ->with('warning', 'Você foi bloqueado');
        }

        return $next($request);
    }

    private function hasFootballerLoggedIn()
    {
        return auth('footballers')->check()
            && auth('footballers')->user()->status == Footballer::STATUS_BLOCKED
            && auth('users')->user() == null;
    }
}
