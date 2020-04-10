<?php

namespace Tir\Store\Option\Entities;

use Tir\Crud\Support\Eloquent\TranslationModel;

class OptionValueTranslation extends TranslationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['label'];
}
