<?php

namespace Tir\Store\Payment\Gateways;

use Tir\Store\Payment\NullResponse;

class BankTransfer
{
    public $label;
    public $description;

    public function __construct()
    {
        $this->label = setting('bank_transfer_label');
        $this->description = setting('bank_transfer_description');
    }

    public function purchase()
    {
        return new NullResponse;
    }
}
