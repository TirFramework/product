<?php

namespace Tir\Store\Payment\Gateways;

use Tir\Setting\Facades\Stg;
use Tir\Store\Payment\NullResponse;

class COD
{
    public $label;
    public $description;

    public function __construct()
    {
        $this->label = Stg::get('cod_label');
        $this->description = Stg::get('cod_description');
    }

    public function purchase()
    {
        return new NullResponse;
    }
}
