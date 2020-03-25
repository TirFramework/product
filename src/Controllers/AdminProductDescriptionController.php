<?php

namespace Tir\Product\Controllers;

use Tir\Product\Models\Product;
use Tir\Crud\Controllers\CrudController;
use Tir\Product\Models\ProductDescription;

class AdminProductDescriptionController extends CrudController
{
    protected $model = ProductDescription::Class;

}
