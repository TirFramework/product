<?php

namespace Tir\Store\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Tir\Crud\Models\CrudModel;

class ProductDescription extends CrudModel
{
    //Additional trait insert here

    public $table = 'product_descriptions';


    public function getValidation()
    {
        return [
             'name' => 'required',
        ];
    }

}
