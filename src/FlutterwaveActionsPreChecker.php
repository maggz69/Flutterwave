<?php


namespace Flutterwave\Payouts;


/**
 * Interface FlutterwaveActionsPreChecker
 * @package Flutterwave\Payouts
 *
 * Check whether a Flutterwave Action Is Ready for Flight (request)
 */
interface FlutterwaveActionsPreChecker
{

    /**
     * @return bool
     *
     * Check and see whether all the required fields
     * are present in the request
     */
    public function checkRequiredFieldsFilled():bool;
}