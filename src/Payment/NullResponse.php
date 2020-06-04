<?php

namespace Tir\Store\Payment;

class NullResponse
{
    public function isRedirect()
    {
        return false;
    }

    public function isSuccessful()
    {
        return true;
    }

    public function getTransactionReference()
    {
        //
    }
}
