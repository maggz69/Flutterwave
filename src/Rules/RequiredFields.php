<?php

namespace Flutterwave\Payouts\Rules;

use Flutterwave\Payouts\Exceptions\MissingRequiredFieldsException;

class RequiredFields
{
    public static function requiredFieldsForClass(string $name = null): string
    {
        $name = $name ?? static::class;

        $namedSections = explode('\\', $name);

        $className = $namedSections[count($namedSections) - 1];
        switch ($className) {
            case 'TransferToBank':
                return 'account_bank,account_number,amount,narration,currency,reference,callback_url,debit_currency,beneficiary_name';
        }

        throw new MissingRequiredFieldsException();
    }
}
