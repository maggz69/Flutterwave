<?php


namespace Flutterwave\Payouts\Exceptions;

use Exception;

class FlutterwaveActionsMalformedException extends Exception
{
    public function getErrorMessage(){
        return "The current setup of your action is malformed. It is either missing a request body, a request configuration and as such cannot be honoured";
    }
}