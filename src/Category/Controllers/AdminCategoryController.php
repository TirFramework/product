<?php

namespace Tir\Store\Category\Controllers;

use Tir\Crud\Controllers\CrudController;
use Tir\Store\Category\Entities\Category;

class AdminCategoryController extends CrudController
{
    protected $model = Category::Class;

    // public function index()
    // {
    //     return $this->model::all();
    // }
   // protected $options = ['datatableServerSide'=>'false'];
}
