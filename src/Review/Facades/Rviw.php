<?php

namespace Tir\Store\Review\Facades;

class Rviw
{
    /**
     * Determine if review form has any error.
     *
     * @param \Illuminate\Support\ViewErrorBag $errors
     * @return bool
     */
    public static function form_has_error($errors)
    {
        return $errors->has('rating') ||
               $errors->has('reviewer_name') ||
               $errors->has('comment') ||
               $errors->has('captcha');
    }
}