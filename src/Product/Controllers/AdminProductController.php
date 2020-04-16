<?php

namespace Tir\Store\Product\Controllers;

use Illuminate\Http\Request;
use Tir\Crud\Controllers\CrudController;
use Tir\Store\Product\Entities\Product;


class AdminProductController extends CrudController
{
    protected $model = Product::Class;

    public function store(Request $request)
    {
        return $request->all();
    }


}
