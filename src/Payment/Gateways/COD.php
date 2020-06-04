<?php

namespace Tir\Store\Payment\Gateways;

use Tir\Store\Payment\NullResponse;

class COD
{
    public $label;
    public $description;

    public function __construct()
    {
        $this->label = setting('cod_label');
        $this->description = setting('cod_description');
    }

    public function purchase()
    {
        return new NullResponse;
    }
}
