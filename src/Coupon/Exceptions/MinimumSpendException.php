<?php

namespace Tir\Store\Coupon\Exceptions;

use Exception;

class MinimumSpendException extends Exception
{
    /**
     * The amount that need to spend.
     *
     * @var \Tir\Store\Support\Money
     */
    private $money;

    /**
     * Create a new instance of the exceptions
     *
     * @param \Tir\Store\Support\Money $money
     */
    public function __construct($money)
    {
        $this->money = $money;
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        return redirect()->route('cart.index')->withInput()
            ->with('error', trans('coupon::messages.minimum_spend', ['amount' => $this->money->format()]));
    }
}
