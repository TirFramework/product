<?php

namespace Tir\Store\Category\Entities;

use Tir\Crud\Entities\CrudModel;
use Tir\Crud\Entities\TranslationModel;

//use Modules\Support\Eloquent\TranslationModel;

class CategoryTranslation extends TranslationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
