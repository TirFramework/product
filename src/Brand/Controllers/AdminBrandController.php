<?php

namespace Tir\Store\Brand\Controllers;

use Tir\Crud\Controllers\CrudController;
use Tir\Store\Brand\Entities\Brand;

class AdminBrandController extends CrudController
{
    protected $model = Brand::Class;

}
