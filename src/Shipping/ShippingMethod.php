<?php

namespace Tir\Store\Shipping;


use Tir\Crud\Support\Services\Manager;

class ShippingMethod extends Manager
{
    public function available()
    {
        return $this->all()->filter->available();
    }
}
