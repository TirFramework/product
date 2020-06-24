<?php

namespace Tir\Store\StoreSetting\Entities;

use Tir\Crud\Support\Eloquent\TranslationModel;


class StoreSettingTranslation extends TranslationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['value'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

}
