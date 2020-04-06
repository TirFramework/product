<?php

namespace Tir\Store\Models;

use Tir\Crud\Models\CrudModel;

class OptionDescription extends CrudModel
{
    //Additional trait insert here

    public $table = 'option_descriptions';


    public function getValidation()
    {
        return [
            'title' => 'required'
        ];
    }

}
