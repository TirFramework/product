<?php


namespace Tir\Store\Product\Support;


use Illuminate\Support\HtmlString;

class Price
{
    //TODO: chenge currency system
    public static $currency = ' تومان';

    public static function render($product, $class = 'previous-price')
    {
        if (! $product->hasSpecialPrice()) {

            return number_format($product->price).self::$currency;
        }

        $price = floor($product->price);
        $specialPrice = number_format($product->special_price).self::$currency;

        return new HtmlString(" <span class='{$class}'>{$price}</span> <span>{$specialPrice}</span>");
    }
}