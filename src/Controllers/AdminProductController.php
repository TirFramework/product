<?php

namespace Tir\Store\Controllers;

use Illuminate\Http\Request;
use Tir\Store\Models\Product;
use Illuminate\Support\Facades\Redirect;
use Tir\Crud\Controllers\CrudController;

class AdminProductController extends CrudController
{
    protected $model = Product::Class;

    // public function edit($id)
    // {
    //    return $this->model::find($id)->attributes()->wherePivot('language_id',2)->get();
    // }
    public function updateAttributes(Request $request,$id)
    {
        $attributes =  $request->all()['attributes'];
        $language =  $request->all()['language_id'];
        $values=[];
        foreach($attributes as $key=>$value){
            if(isset($value['value'])){
                array_push($values, ['attribute_id'=>"$key", 'product_id'=>$id, 'language_id'=>$language,'value'=>$value['value']]);
            }
        }

        \DB::table('attribute_product')
        ->where('product_id',$id)
        ->where('language_id',$language)
        ->delete();

       // return $values;
        \DB::table('attribute_product')->insert($values);


        return Redirect::back();





        
        $attributes =  $request->all()['attributes'];
        $language =  $request->all()['language_id'];
        //$item = $this->model::find($id)->attributes();

        $attributeValues = [];
        $languageValues = [];


            foreach($attributes as $key=>$value){
                if(isset($value['value'])){
                    $attributeValues[$key] = ['value'=>$value['value'],'language_id'=>0];
                }
            }

            foreach($attributes as $key=>$value){
                if(isset($value['value'])){
                    $languageValues[$key] = ['language_id'=>$language];
                }
            }
           // return $attributeValues;
            $this->model::find($id)->attributes()->sync($attributeValues);
            $this->model::find($id)->attributesLang()->syncWithoutDetaching($value);


        return Redirect::back();
    }
}
