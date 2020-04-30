<?php


namespace Tir\Store\Product\Support;


use Illuminate\Support\HtmlString;

class Price
{

    public static $currency = '$';

    public static function render($product, $class = 'previous-price')
    {
        if (! $product->hasSpecialPrice()) {
            return self::$currency.floor($product->price);
        }

        $price = floor($product->price);
        $specialPrice = self::$currency.floor($product->special_price);

        return new HtmlString("<span>{$specialPrice}</span> <span class='{$class}'>{$price}</span>");
    }
}