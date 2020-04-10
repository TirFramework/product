<?php

namespace Tir\Store\Option\Entities;

use Tir\Crud\Entities\CrudModel;
use Astrotomic\Translatable\Translatable;

class OptionValue extends CrudModel
{
    //Additional trait insert here
    
    use Translatable;


    public $table = 'option_values';

    protected $fillable = ['label','price_type', 'price','position'];

    public $translatedAttributes = ['label'];

}
