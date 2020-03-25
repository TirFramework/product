<?php

namespace Tir\Product\Controllers;

use Tir\Product\Models\Product;
use Tir\Crud\Controllers\CrudController;

class AdminProductController extends CrudController
{
    protected $model = Product::Class;


}
