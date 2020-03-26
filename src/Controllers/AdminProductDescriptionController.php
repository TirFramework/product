<?php

namespace Tir\Store\Controllers;

use Tir\Crud\Controllers\CrudController;
use Tir\Store\Models\ProductDescription;

class AdminProductDescriptionController extends CrudController
{
    protected $model = ProductDescription::Class;

}
