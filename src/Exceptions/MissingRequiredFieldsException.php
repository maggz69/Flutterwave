<?php

namespace Flutterwave\Payouts\Exceptions;

use Exception;

class MissingRequiredFieldsException extends Exception
{
    public function errorMessage()
    {
        $message = "We could not find the exact any required fields for the action you are requesting. Add 'force'=>true to the config to bypass checking for required fields";
    }
}
