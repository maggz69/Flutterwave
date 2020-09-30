##Flutterwave Laravel Package

This is a laravel package that allows you to access 
and utilize the Flutterwave API from a laravel application.

### Functions
The following are the supported API's , this checklist also 
defines the roadmap I will be working with. 
- [x] Bank Payouts
- [ ] Mobile Money Payouts
- [ ] Online Payments

## Installation

Install via Composer
```php
composer require maggz69/flutterwave;
```
Publish The Config File
```php
php artisan vendor:publish --tag=config
```
Add The Flutterwave `API_KEY` to your .env file
 
## Usage
 
 ```php

use Flutterwave\Payouts\Actions\TransferToBank;

$transactionData = [
    'account_bank'=>'044',
    'account_number'=>'0690000040',
    'amount'=>4500,
    'narration'=>'Aehlm Pstmn Trnsfr xx007',
    'currency'=>'KES',
    'reference'=>'ashlm-pstmnpyt-rfxx007_PMCKDU_1',
    'callback_url'=>'localhost',
    'debit_currency'=>'KES',
    'beneficiary_name'=>'Tony Stark'];


$transactionToBank = new TransferToBank(null,$transactionData);
$response = $transactionToBank->run();
dd($response);


```
