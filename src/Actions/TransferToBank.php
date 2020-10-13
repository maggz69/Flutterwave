<?php

namespace Flutterwave\Payouts\Actions;

use Exception;
use Flutterwave\Payouts\Exceptions\FlutterwaveActionsMalformedException;
use Flutterwave\Payouts\FlutterwaveActionsPreChecker;
use Flutterwave\Payouts\NetworkChef;
use Flutterwave\Payouts\Rules\RequiredFields;

/**
 * Class TransferToBank.
 */
class TransferToBank extends NetworkChef implements FlutterwaveActionsPreChecker
{
    // The ENDPOINT that is going to be hit by the API as well
    // as the METHOD being used to hit the endpoint
    protected const ENDPOINT = 'POST:transfers';

    public function __construct(array $config = null, array $body = null)
    {
        if (isset($config)) {
            parent::__construct($config);
        } else {
            $config = [
                'base_url'   => config('flutterwave.base_url'),
                'api_version'=> config('flutterwave.api_version'),

            ];
            parent::__construct($config);
        }

        if (isset($body)) {
            $this->setRequestBody($body);
        }

        $this->setEndpoint(self::ENDPOINT);
    }

    public function run()
    {
        $this->checkRequestBodyFilled();
        $this->checkRequiredFieldsFilled();

        return $this->makeRequest();
    }

    public function checkRequestBodyFilled()
    {
        if ($this->getRequestBody() == null) {
            throw new FlutterwaveActionsMalformedException('Request Body Is Missing');
        }
    }

    public function checkRequiredFieldsFilled(): bool
    {
        $requiredFieldsArray = explode(',', RequiredFields::requiredFieldsForClass(get_class($this)));

        foreach ($requiredFieldsArray as $requiredField) {
            if (!array_key_exists($requiredField, $this->getRequestBody())) {
                throw new Exception('Missing Required Field :'.$requiredField);
            }
        }

        return true;
    }
}
