<?php

namespace Tir\Store\Category\Controllers;

use Illuminate\Support\Facades\Auth;
use Tir\Crud\Controllers\CrudController;
use Tir\Store\Category\Entities\Category;

class AdminCategoryController extends CrudController
{
    protected $model = Category::Class;

}
