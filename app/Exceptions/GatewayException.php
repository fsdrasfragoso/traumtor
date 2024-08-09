<?php

namespace App\Exceptions;

use Exception;

class GatewayException extends Exception
{
    public static function getValidationMessage($errors)
    {
        $message = 'Validation - ' . json_encode($errors);

        return $message;
    }
}
