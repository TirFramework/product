<?php

namespace Tir\Store\Attribute\Entities;

use Tir\Crud\Support\Eloquent\CrudModel;
use Astrotomic\Translatable\Translatable;

class ProductAttribute extends CrudModel
{
    //Additional trait insert here
    

    public $table = 'product_attributes';

    protected $fillable = ['attribute_id'];

    public $timestamps = false;


    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['attribute', 'values'];



    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function values()
    {
        return $this->hasMany(ProductAttributeValue::class, 'product_attribute_id');
    }

    public function getNameAttribute()
    {
        return $this->attribute->name;
    }

    public function getAttributeSetAttribute()
    {
        return $this->attribute->attribute_set->name;
    }

}
