<?php

namespace App\Http\Controllers\Frontend\Concerns;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiter;

trait ThrottlesRequests
{
    /**
     * Determine if the user has too many failed request attempts.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function hasTooManyRequestAttempts(Request $request, $prefix = null)
    {
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request, $prefix), $this->maxAttempts()
        );
    }

    /**
     * Increment the request attempts for the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function incrementRequestAttempts(Request $request, $prefix = null)
    {
        $this->limiter()->hit(
            $this->throttleKey($request, $prefix), $this->decaySeconds()
        );
    }

    /**
     * Clear the request locks for the given user credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function clearRequestAttempts(Request $request, $prefix = null)
    {
        $this->limiter()->clear($this->throttleKey($request, $prefix));
    }

    /**
     * Get the throttle key for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function throttleKey(Request $request, $prefix = null)
    {
        $key = $prefix ?? 'request';

        return Str::lower($key.'|'.$request->ip());
    }

    /**
     * Get the rate limiter instance.
     *
     * @return \Illuminate\Cache\RateLimiter
     */
    protected function limiter()
    {
        return app(RateLimiter::class);
    }

    /**
     * Get the maximum number of attempts to allow.
     *
     * @return int
     */
    public function maxAttempts()
    {
        return property_exists($this, 'maxAttempts') ? $this->maxAttempts : 5;
    }

    /**
     * Get the number of minutes to throttle for.
     *
     * @return int
     */
    public function decaySeconds()
    {
        return property_exists($this, 'decaySeconds') ? $this->decaySeconds : 60;
    }
}
