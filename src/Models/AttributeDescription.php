<?php

namespace Tir\Store\Models;

use Tir\Crud\Models\CrudModel;

class AttributeDescription extends CrudModel
{
    //Additional trait insert here

    public $table = 'attribute_descriptions';


    public function getValidation()
    {
        return [
            'title' => 'required'
        ];
    }

}
