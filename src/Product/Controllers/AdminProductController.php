<?php

namespace Tir\Store\Product\Controllers;

use Tir\Crud\Controllers\CrudController;
use Tir\Store\Product\Entities\Product;


class AdminProductController extends CrudController
{
    protected $model = Product::Class;

}
