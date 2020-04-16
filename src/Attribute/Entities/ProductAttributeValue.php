<?php

namespace Tir\Store\Attribute\Entities;

use Tir\Crud\Support\Eloquent\CrudModel;
use Astrotomic\Translatable\Translatable;

class ProductAttributeValue extends CrudModel
{
    //Additional trait insert here
    

    public $table = 'product_attribute_values';

    protected $fillable = ['product_attribute_id', 'attribute_id'];

    protected $with = ['attributeValue'];

    public function exists()
    {
        return ! is_null($this->attributeValue);
    }

    public function attributeValue()
    {
        return $this->belongsTo(AttributeValue::class, 'attribute_value_id');
    }

    public function getIdAttribute()
    {
        return $this->attributeValue->id;
    }

    public function getValueAttribute()
    {
        return $this->attributeValue->value;
    }


}
