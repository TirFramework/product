<?php

namespace Tir\Store\Coupon\Entities;

use Tir\Store\Support\Eloquent\TranslationModel;

class CouponTranslation extends TranslationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
