<?php

namespace App\Providers;

use App\Interfaces\PaymentGatewayInterface;
use App\Services\PaymobPaymentService;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void {


        $this->app->bind(PaymentGatewayInterface::class, PaymobPaymentService::class);


    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
