<?php

namespace Tir\Store\Tax\Entities;

use Tir\Store\Support\Eloquent\TranslationModel;

class TaxRateTranslation extends TranslationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
