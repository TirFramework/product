<?php

namespace Tir\Store\Brand\Entities;

use Tir\Crud\Support\Eloquent\CrudModel;
use Tir\Crud\Support\Eloquent\TranslationModel;

//use Tir\Store\Support\Eloquent\TranslationModel;

class BrandTranslation extends TranslationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description'];
}
