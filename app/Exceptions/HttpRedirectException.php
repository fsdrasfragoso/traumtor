<?php

namespace App\Exceptions;

use Illuminate\Http\RedirectResponse;
use RuntimeException;

class HttpRedirectException extends RuntimeException
{
    /**
     * Redirect to route.
     *
     * @var string
     */
    protected $redirect;

    /**
     * HttpRedirectException constructor.
     *
     * @param string $message
     * @param string $redirect
     */
    public function __construct($message, $redirect)
    {
        $this->redirect = $redirect;
        $this->message = $message;
    }

    /**
     * Redirects user and flashes message.
     *
     * @return RedirectResponse
     */
    public function redirect()
    {
        $type = $this->redirect == '/' ? 'warning-home' : 'warning';

        return redirect($this->redirect)
            ->with($type, $this->message)
            ->withInput();
    }
}
