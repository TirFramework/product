<?php

namespace Tir\Store\Payment;

use Tir\Setting\Facades\Stg;
use Tir\Store\Payment\Gateways\COD;
use Tir\Store\Payment\Facades\Gateway;
use Tir\Store\Payment\Gateways\Stripe;
use Illuminate\Support\ServiceProvider;
use Tir\Store\Payment\Gateways\Instamojo;
use Tir\Store\Payment\Gateways\BankTransfer;
use Tir\Store\Payment\Gateways\CheckPayment;
use Tir\Store\Payment\Gateways\PayPalExpress;
use Tir\Store\Payment\Gateways\PasargadGeteway;

class GatewayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');


        if (!config('app.installed')) {
            return;
        }
        $this->registerPayPalExpress();
        $this->registerStripe();
        $this->registerInstamojo();
        $this->registerCashOnDelivery();
        $this->registerBankTransfer();
        $this->registerCheckPayment();
        $this->registerPasargadGateWay();

        $this->loadViewsFrom(__DIR__ . '/Resources/Views/', 'gateway');

    }

    private function enabled($paymentMethod)
    {
//        Todo: check inBackend
        //        if (app('inBackend')) {
//            return true;
//        }

        return Stg::get("{$paymentMethod}_enabled");
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
        //disable
//        if ((Stg::get('instamojo_enabled') && currency() === 'INR') || app('inBackend')) {
//            Gateway::register('instamojo', new Instamojo);
//        }
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

    private function registerPasargadGateWay()
    {
        //if ($this->enabled('irbank_payment')) {
        Gateway::register('pasargad_gateway', new PasargadGeteway);
        // }
    }
}
