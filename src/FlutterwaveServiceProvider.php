<?php


namespace Flutterwave\Payouts;

use Illuminate\Support\ServiceProvider;


class FlutterwaveServiceProvider extends ServiceProvider
{
    public function boot(){
        $this->publishes([
            __DIR__.'/flutterwave.php' => config_path('flutterwave.php'),
        ],'config');
    }

    public function register(){

    }
}