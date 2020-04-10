<?php

namespace Tir\Store\Attribute\Entities;

use Tir\Crud\Support\Eloquent\CrudModel;
use Tir\Crud\Support\Eloquent\TranslationModel;

//use Modules\Support\Eloquent\TranslationModel;

class AttributeTranslation extends TranslationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
