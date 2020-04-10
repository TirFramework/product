<?php

namespace Tir\Store\Option\Controllers;

use Tir\Crud\Controllers\CrudController;
use Tir\Store\Option\Entities\Product;


class AdminProductController extends CrudController
{
    protected $model = Product::Class;

}
