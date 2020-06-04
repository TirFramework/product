<?php

namespace Tir\Store\Payment\Providers;

use Tir\Store\Payment\Gateways\COD;
use Tir\Store\Payment\Facades\Gateway;
use Tir\Store\Payment\Gateways\Stripe;
use Illuminate\Support\ServiceProvider;
use Tir\Store\Payment\Gateways\Instamojo;
use Tir\Store\Payment\Gateways\BankTransfer;
use Tir\Store\Payment\Gateways\CheckPayment;
use Tir\Store\Payment\Gateways\PayPalExpress;

class GatewayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (! config('app.installed')) {
            return;
        }

        $this->registerPayPalExpress();
        $this->registerStripe();
        $this->registerInstamojo();
        $this->registerCashOnDelivery();
        $this->registerBankTransfer();
        $this->registerCheckPayment();
    }

    private function enabled($paymentMethod)
    {
        if (app('inBackend')) {
            return true;
        }

        return setting("{$paymentMethod}_enabled");
    }

    private function registerPayPalExpress()
    {
        if ($this->enabled('paypal_express')) {
            Gateway::register('paypal_express', new PayPalExpress);
        }
    }

    private function registerStripe()
    {
        if ($this->enabled('stripe')) {
            Gateway::register('stripe', new Stripe);
        }
    }

    private function registerInstamojo()
    {
        if ((setting('instamojo_enabled') && currency() === 'INR') || app('inBackend')) {
            Gateway::register('instamojo', new Instamojo);
        }
    }

    private function registerCashOnDelivery()
    {
        if ($this->enabled('cod')) {
            Gateway::register('cod', new COD);
        }
    }

    private function registerBankTransfer()
    {
        if ($this->enabled('bank_transfer')) {
            Gateway::register('bank_transfer', new BankTransfer);
        }
    }

    private function registerCheckPayment()
    {
        if ($this->enabled('check_payment')) {
            Gateway::register('check_payment', new CheckPayment);
        }
    }
}
