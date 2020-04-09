<?php

namespace Tir\Store\Attribute\Entities;

use Tir\Crud\Entities\TranslationModel;

class AttributeValueTranslation extends TranslationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['value'];
}
