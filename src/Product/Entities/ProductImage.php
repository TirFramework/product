<?php

namespace Tir\Store\Product\Entities;

use Tir\Crud\Support\Eloquent\CrudModel;

class ProductImage extends CrudModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $timestamps = false;

    protected $fillable = ['product_id', 'url'];

    public $table = 'product_images';

}
