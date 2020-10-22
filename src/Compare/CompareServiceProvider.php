<?php

namespace Tir\Store\Compare;

use Tir\Store\Compare\Compare;
use Illuminate\Support\ServiceProvider;

class CompareServiceProvider extends ServiceProvider
{

    private $configs = [];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->configs = [
            'format_numbers' => env('SHOPPING_FORMAT_VALUES', false),
            'decimals' => env('SHOPPING_DECIMALS', 0),
            'dec_point' => env('SHOPPING_DEC_POINT', '.'),
            'thousands_sep' => env('SHOPPING_THOUSANDS_SEP', ',')
        ];

        $this->app->singleton(Compare::class, function ($app) {
            return new Compare(
                $app['session'],
                $app['events'],
                'compare',
                session()->getId() . '_compare',
                $this->configs
            );
        });

        $this->app->alias(Compare::class, 'compare');

        //Compare module
        $this->loadRoutesFrom(__DIR__ . '/Routes/public.php');
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
        $this->loadTranslationsFrom(__DIR__ . '/Resources/lang/', 'compare');


    }
}
