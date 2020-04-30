<?php
namespace Tir\Store\Currency\Facades;

use Illuminate\Support\Facades\Cookie;
use Tir\Setting\Facades\Stg;

class Crnc{

    /**
     * Get current currency.
     *
     * @return string
     */
    public static function get()
    {
//        if (app('inBackend')) {
//            return Stg::get('default_currency');
//        }

        $currency = Cookie::get('currency');

        if (! in_array($currency, Stg::get('supported_currencies'))) {
            $currency = Stg::get('default_currency');
        }

        return $currency;
    }
}