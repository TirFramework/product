<?php

namespace Tir\Store\Attribute\Facades;

use Illuminate\Support\Arr;

class Attr
{
    /**
     * Check if current route is filter products using given value of attributes.
     *
     * @param string $value
     * @return bool
     */
    public static function is_filtering($value)
    {
        $value = mb_strtolower($value);
        $requestQueries = Arr::flatten(request('attribute', []));

        return in_array($value, $requestQueries);
    }

}