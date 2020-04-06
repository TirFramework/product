<?php

namespace Tir\Store\Models;

use Tir\Crud\Models\CrudModel;

class OptionValue extends CrudModel
{
    //Additional trait insert here


    public static $routeName = 'option_values';


    public function getValidation()
    {
        return [
            'option_id' => 'required',
        ];
    }
    



    public function descriptions()
    {
            return $this->hasMany(OptionValueDescription::class,'option_value_id');
    }       
}
