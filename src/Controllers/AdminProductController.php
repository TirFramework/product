<?php

namespace Tir\Store\Controllers;

use Tir\Store\Models\Product;
use Tir\Crud\Controllers\CrudController;

class AdminProductController extends CrudController
{
    protected $model = Product::Class;
}
