<?php

namespace Tir\Store\Category\Database\Seeders;

use Illuminate\Database\Seeder;
use Tir\Store\Category\Entities\Category;

class CategoryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class, 20)->create();
    }
}
