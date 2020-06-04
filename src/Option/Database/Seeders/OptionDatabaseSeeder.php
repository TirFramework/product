<?php

namespace Tir\Store\Option\Database\Seeders;

use Illuminate\Database\Seeder;
use Tir\Store\Option\Entities\Option;
use Tir\Store\Option\Entities\OptionValue;

class OptionDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Option::class, 10)
            ->create()
            ->each(function ($option) {
                $times = $option->type === 'dropdown' ? 5 : 1;

                factory(OptionValue::class, $times)->create(['option_id' => $option->id]);
            });
    }
}
