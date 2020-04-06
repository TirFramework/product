<?php

namespace Tir\Store\Models;

use Tir\Crud\Models\CrudModel;

class OptionValueDescription extends CrudModel
{
    //Additional trait insert here


    public static $routeName = 'option_value_description';


    public function getValidation()
    {
        return [
            'name' => 'required',
        ];
    }
    


    public function getFields()
    {
        $fields = [
                       
        ];

        return json_decode(json_encode($fields));
    }


   
}
