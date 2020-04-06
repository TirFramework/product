<?php

namespace Tir\Store\Controllers;

use Tir\Store\Models\Option;
use Illuminate\Http\Request;
use Tir\Crud\Controllers\CrudController;
use Tir\Store\Models\OptionValue;

class AdminOptionController extends CrudController
{
    protected $model = Option::Class;


    public function updateOptionValue(Request $request, $id){

        $optionValues =  $request->all()['option_value'];
        $language =  $request->all()['language_id'];
        $optionId = $id;
        $values=[];
        $translates = [];

        
        foreach($optionValues as $value){
                //array_push($values, ['option_id'=>"$optionId", 'image'=>$value['image'], 'sort_order'=>$value['sort_order']]);
                $value = ['option_id'=>"$optionId", 'image'=>$value['image'], 'sort_order'=>$value['sort_order']];
                $optionValue = OptionValue::updateOrCreate($value);
                $optionValue->descriptions()->
        }
        //return $values;
        //return OptionValue::insert($values);
        //return $values;


    }

}
