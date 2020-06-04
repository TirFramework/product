<?php


namespace Tir\Store\Product\Support;


use Illuminate\Support\HtmlString;

class Price
{
    //TODO: chenge currency system

    public static function render($product, $class = 'previous-price')
    {
        if (! $product->hasSpecialPrice()) {

            return $product->price->convertToCurrentCurrency()->format();
        }

        $price = $product->price->convertToCurrentCurrency()->format();
        $specialPrice = $product->special_price->convertToCurrentCurrency()->format();

        return new HtmlString(" <span class='{$class}'>{$price}</span> <span>{$specialPrice}</span>");
    }
}