<?php

namespace Tir\Store\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Tir\Crud\Models\CrudModel;

class WeightTypeDescription extends CrudModel
{
    //Additional trait insert here

    public $table = 'weight_type_descriptions';


    public function getValidation()
    {
        return [
             'name' => 'required',
        ];
    }

}
