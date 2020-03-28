<?php

namespace Tir\Store\Models;

use Tir\Crud\Models\CrudModel;

class SizeTypeDescription extends CrudModel
{
    //Additional trait insert here

    public $table = 'size_type_descriptions';


    public function getValidation()
    {
        return [
            'title' => 'required',
            'unit' => 'required',
        ];
    }

}
