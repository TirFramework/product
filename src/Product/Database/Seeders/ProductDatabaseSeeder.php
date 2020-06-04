<?php

namespace Tir\Store\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Tir\Store\Product\Entities\Product;

class ProductDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Product::class, 20)->create();
    }
}
