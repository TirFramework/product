<?php

namespace Tir\Store\Attribute\Entities;

use Tir\Crud\Support\Eloquent\CrudModel;
use Tir\Crud\Support\Eloquent\Translatable;

class AttributeValue extends CrudModel 
{
    //Additional trait insert here
    
    use Translatable;


    public $table = 'attribute_values';

    protected $with = ['translations'];

    protected $fillable = ['value','position','attribute_id'];

    public $translatedAttributes = ['value'];



}
