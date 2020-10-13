<?php

namespace Flutterwave\Payouts\Dummy;


class DummyData
{

    public static function payoutResponse(){
        $sampleResponse = array (
            'status' => 'success',
            'message' => 'Transfer Queued Successfully',
            'data' =>
                array (
                    'id' => 36000,
                    'account_number' => '0690000040',
                    'bank_code' => '044',
                    'full_name' => 'Alexis Sanchez',
                    'created_at' => '2020-04-28T13:18:15.000Z',
                    'currency' => 'NGN',
                    'debit_currency' => 'NGN',
                    'amount' => 5500,
                    'fee' => 26.875,
                    'status' => 'NEW',
                    'reference' => 'akhlm-pstmnpyt-rfxx007_PMCKDU_1',
                    'meta' => NULL,
                    'narration' => 'Akhlm Pstmn Trnsfr xx007',
                    'complete_message' => '',
                    'requires_approval' => 0,
                    'is_approved' => 1,
                    'bank_name' => 'ACCESS BANK NIGERIA',
                ),
        );
        return json_encode($sampleResponse);
    }

}