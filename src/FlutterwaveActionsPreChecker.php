<?php

namespace Flutterwave\Payouts;

/**
 * Interface FlutterwaveActionsPreChecker.
 */
interface FlutterwaveActionsPreChecker
{
    /**
     * @return bool
     *
     * Check and see whether all the required fields
     * are present in the request
     */
    public function checkRequiredFieldsFilled(): bool;
}
