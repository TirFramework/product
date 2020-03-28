<?php

namespace Tir\Store\Models;

use Tir\Crud\Models\CrudModel;

class AttributeGroupDescription extends CrudModel
{
    //Additional trait insert here

    public $table = 'attribute_group_descriptions';


    public function getValidation()
    {
        return [
            'title' => 'required'
        ];
    }

}
