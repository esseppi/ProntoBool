<?php

namespace App\Providers;

use Braintree\Gateway;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
    {
        // $gateway = new \Braintree\Gateway([
        //     'environment' => env('BRAINTREE_ENVIRONMENT'),
        //     'merchantId' => env("BRAINTREE_MERCHANT_ID"),
        //     'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
        //     'privateKey' => env("BRAINTREE_PRIVATE_KEY")
        // ]);
        $this->app->singleton(Gateway::class, function ($app) {
            return new Gateway(
                [
                    'environment' => 'sandbox',
                    'merchantId' => 'xfj6ygs7jfxxb9b3',
                    'publicKey' => '34vkghzfsks2y93h',
                    'privateKey' => '1b16438e7eb59a64708723ea1cc6768b'
                ]

            );
        });
    }
}
