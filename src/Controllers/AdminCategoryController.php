<?php

namespace Tir\Store\Controllers;

use Tir\Crud\Controllers\CrudController;
use Tir\Store\Models\Category;

class AdminCategoryController extends CrudController
{
    protected $model = Category::Class;

   // protected $options = ['datatableServerSide'=>'false'];
}
