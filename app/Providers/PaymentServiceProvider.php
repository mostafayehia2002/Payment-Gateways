<?php

namespace App\Providers;

use App\Interfaces\PaymentGatewayInterface;
use Illuminate\Support\ServiceProvider;
use App\Services\TapPaymentService;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {


        $this->app->bind(PaymentGatewayInterface::class, TapPaymentService::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
