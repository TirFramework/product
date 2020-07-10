<?php

namespace Tir\Store\Tax\Entities;


use Tir\Crud\Support\Eloquent\TranslationModel;

class TaxClassTranslation extends TranslationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['label'];
}
