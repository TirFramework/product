<?php

namespace Tir\Store\Order\Entities;

use Tir\Crud\Support\Eloquent\CrudModel;
use Tir\Store\Currency\Support\Money;
use Tir\Store\Support\State;
use Tir\Store\Support\Country;
use Tir\Store\Tax\Entities\TaxRate;
use Illuminate\Support\Facades\DB;
use Tir\Store\Coupon\Entities\Coupon;
use Tir\Store\Payment\Facades\Gateway;
use Tir\Store\Shipping\Facades\ShippingMethod;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tir\Store\Transaction\Entities\Transaction;

class Order extends CrudModel
{
    use SoftDeletes;

    const CANCELED = 'canceled';
    const COMPLETED = 'completed';
    const ON_HOLD = 'on_hold';
    const PENDING = 'pending';
    const PENDING_PAYMENT = 'pending_payment';
    const PROCESSING = 'processing';
    const REFUNDED = 'refunded';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['start_date', 'end_date', 'deleted_at'];

    protected $appends = ['order_time'];


    public static $routeName = 'order';

    public function getFields()
    {
        return  [
            [
                'name'    => 'basic_information',
                'type'    => 'group',
                'visible' => 'ce',
                'tabs'    => [
                    [
                        'name'    => 'order_account_information',
                        'type'    => 'tab',
                        'visible' => 'ce',
                        'fields'  => [
                            [
                                'name'    => 'id',
                                'type'    => 'text',
                                'visible' => 'io',
                            ],
                            [
                                'name' => 'order_information',
                                'type' => 'blank',
                                'value' => '<h5>'.trans('order::panel.order_information'). '</h5><hr >',
                                'visible' => 'e'
                            ],
                            [
                                'name' => 'order_time',
                                'type' => 'text',
                                'option' => 'readonly',
                                'col' => 'col-sm-6',
                                'searchable' => false,
                                'visible' => 'ie'
                            ],
                            [
                                'name'    => 'status',
                                'type'    => 'select',
                                'col' => 'col-sm-6',
                                'data'    => [
                                    'pending'         => trans('order::panel.pending'),
                                    'pending_payment' => trans('order::panel.pending_payment'),
                                    'canceled' => trans('order::panel.canceled'),
                                    'completed' => trans('order::panel.completed'),
                                    'processing' => trans('order::panel.processing'),
                                    'refunded' => trans('order::panel.refunded'),
                                ],
                                'visible' => 'ief'
                            ],
                            [
                                'name'=>'shipping_method',
                                'type' => 'text',
                                'col' => 'col-sm-6',
                                'visible' => 'e',
                            ],
                            [
                                'name'=>'payment_method',
                                'type' => 'text',
                                'col' => 'col-sm-6',
                                'visible' => 'e',
                            ],

                            [
                                'name' => 'account_information',
                                'type' => 'blank',
                                'value' => '<h5>'.trans('order::panel.account_information'). '</h5><hr/>',
                                'visible' => 'e'
                            ],
                            [
                                'name'    => 'customer_first_name',
                                'type'    => 'text',
                                'col' => 'col-sm-6',
                                'visible' => 'ies',
                            ],
                            [
                                'name'    => 'customer_last_name',
                                'type'    => 'text',
                                'col' => 'col-sm-6',
                                'visible' => 'ies',
                            ],
                            [
                                'name'    => 'customer_email',
                                'type'    => 'text',
                                'col' => 'col-sm-6',
                                'visible' => 'ies',
                            ],
                            [
                                'name'    => 'customer_phone',
                                'type'    => 'text',
                                'col' => 'col-sm-6',
                                'visible' => 'es',
                            ],
                            [
                                'name'    => 'customer_group',
                                'type'    => 'text',
                                'col' => 'col-sm-6',
                                'visible' => 'es',
                            ],
                            [
                                'name' => 'order_information',
                                'type' => 'blank',
                                'value' => '<h5>'.trans('order::panel.order_details'). '</h5><hr >',
                                'visible' => 'e'
                            ],
                            [
                                'name' => 'product',
                                'type' => 'product',
                                'visible' => 'e'
                            ]


                        ]
                    ],
                    [
                        'name'    => 'address_information',
                        'type'    => 'tab',
                        'visible' => 'ce',
                        'fields'  => [
                            [
                                'name' => 'billing_address',
                                'type' => 'blank',
                                'value' => '<h5>'.trans('order::panel.billing_address'). '</h5><hr/>',
                                'visible' => 'e'
                            ],
                            [
                                'name'    => 'billing_first_name',
                                'type'    => 'text',
                                'col' => 'col-sm-6',
                                'visible' => 'es',
                            ],
                            [
                                'name'    => 'billing_last_name',
                                'type'    => 'text',
                                'col' => 'col-sm-6',
                                'visible' => 'es',
                            ],
                            [
                                'name'    => 'billing_country',
                                'type'    => 'text',
                                'col' => 'col-sm-6',
                                'visible' => 'es',
                            ],
                            [
                                'name'    => 'billing_state',
                                'type'    => 'text',
                                'col' => 'col-sm-6',
                                'visible' => 'es',
                            ],
                            [
                                'name'    => 'billing_city',
                                'type'    => 'text',
                                'col' => 'col-sm-6',
                                'visible' => 'es',
                            ],
                            [
                                'name'    => 'billing_address_1',
                                'type'    => 'text',
                                'col' => 'col-sm-6',
                                'visible' => 'es',
                            ],
                            [
                                'name'    => 'billing_address_2',
                                'type'    => 'text',
                                'col' => 'col-sm-6',
                                'visible' => 'es',
                            ],
                            [
                                'name' => 'shipping_address',
                                'type' => 'blank',
                                'value' => '<h5>'.trans('order::panel.shipping_address'). '</h5><hr/>',
                                'visible' => 'e'
                            ],
                            [
                                'name'    => 'shipping_first_name',
                                'type'    => 'text',
                                'col' => 'col-sm-6',
                                'visible' => 'es',
                            ],
                            [
                                'name'    => 'shipping_last_name',
                                'type'    => 'text',
                                'col' => 'col-sm-6',
                                'visible' => 'es',
                            ],
                            [
                                'name'    => 'shipping_country',
                                'type'    => 'text',
                                'col' => 'col-sm-6',
                                'visible' => 'es',
                            ],
                            [
                                'name'    => 'shipping_state',
                                'type'    => 'text',
                                'col' => 'col-sm-6',
                                'visible' => 'es',
                            ],
                            [
                                'name'    => 'shipping_city',
                                'type'    => 'text',
                                'col' => 'col-sm-6',
                                'visible' => 'es',
                            ],
                            [
                                'name'    => 'shipping_address_1',
                                'type'    => 'text',
                                'col' => 'col-sm-6',
                                'visible' => 'es',
                            ],
                            [
                                'name'    => 'shipping_address_2',
                                'type'    => 'text',
                                'col' => 'col-sm-6',
                                'visible' => 'es',
                            ]


                        ]
                    ],
                    [
                        'name'    => 'payment_information',
                        'type'    => 'tab',
                        'visible' => 'ce',
                        'fields'  => [
                            [
                                'name' => "transaction[transaction_id]",
                                'display' => 'id',
                                'type' => 'text',
                                'option' => 'readonly',
                                'visible' => 'e'
                            ],
                            [
                                'name' => 'transaction[status]',
                                'display' => 'status',
                                'type' => 'text',
                                'option'  => 'readonly',
                                'visible' => 'e'
                            ],

                            [
                                'name'=>'transaction[created_at]',
                                'display' => 'created_at',
                                'type' => 'text',
                                'option'  => 'readonly',
                                'visible' => 'e',
                            ],
                            [
                                'name' => 'transaction[paid_at]',
                                'display' => 'paid_at',
                                'type' => 'text',
                                'option'  => 'readonly',
                                'visible' => 'e'
                            ],

                        ]
                    ],

                ]
            ]
        ];


    }



    public static function totalSales()
    {
        $total = static::whereNotIn('status', ['canceled', 'refunded'])->sum('total');

        return Money::inDefaultCurrency($total);
    }

    public function getOrderTimeAttribute()
    {
        return jdate($this->created_at)->format('Y/m/d H:m');
    }

    public function status()
    {
        return trans("order::statuses.{$this->status}");
    }

    public function hasShippingMethod()
    {
        return ! is_null($this->shipping_method);
    }

    public function hasCoupon()
    {
        return ! is_null($this->coupon);
    }

    public function hasTax()
    {
        return $this->taxes->isNotEmpty();
    }

    public static function salesAnalytics()
    {
        return static::selectRaw('SUM(total) as total')
            ->selectRaw('COUNT(*) as total_orders')
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->selectRaw('EXTRACT(DAY FROM created_at) as day')
            ->groupBy(DB::raw('EXTRACT(DAY FROM created_at)'))
            ->orderby('day')
            ->get();
    }

    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class)->withTrashed();
    }

    public function taxes()
    {
        return $this->belongsToMany(TaxRate::class, 'order_taxes')
            ->using(OrderTax::class)
            ->as('order_tax')
            ->withPivot('amount')
            ->withTrashed();
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class)->withTrashed();
    }

    public function getSubTotalAttribute($subTotal)
    {
        return Money::inDefaultCurrency($subTotal);
    }

    public function getShippingCostAttribute($shippingCost)
    {
        return Money::inDefaultCurrency($shippingCost);
    }

    public function getDiscountAttribute($discount)
    {
        return Money::inDefaultCurrency($discount);
    }

    public function getTaxAttribute($tax)
    {
        return Money::inDefaultCurrency($tax);
    }

    public function getTotalAttribute($total)
    {
        return Money::inDefaultCurrency($total);
    }

    /**
     * Get the order's shipping method.
     *
     * @param string $shippingMethod
     * @return string
     */
    public function getShippingMethodAttribute($shippingMethod)
    {
        return ShippingMethod::get($shippingMethod)->label ?? '';
    }

    /**
     * Get the order's payment method.
     *
     * @param string $paymentMethod
     * @return string
     */
    public function getPaymentMethodAttribute($paymentMethod)
    {
        return Gateway::get($paymentMethod)->label ?? '';
    }

    public function getCustomerFullNameAttribute()
    {
        return "{$this->customer_first_name} {$this->customer_last_name}";
    }

    public function getBillingFullNameAttribute()
    {
        return "{$this->billing_first_name} {$this->billing_last_name}";
    }

    public function getShippingFullNameAttribute()
    {
        return "{$this->shipping_first_name} {$this->shipping_last_name}";
    }

    public function getBillingCountryNameAttribute()
    {
        return Country::name($this->billing_country);
    }

    public function getShippingCountryNameAttribute()
    {
        return Country::name($this->shipping_country);
    }

    public function getBillingStateNameAttribute()
    {
        return State::name($this->billing_country, $this->billing_state);
    }

    public function getShippingStateNameAttribute()
    {
        return State::name($this->shipping_country, $this->shipping_state);
    }

    public function storeProducts($cartItem)
    {
        $orderProduct = $this->products()->create([
            'product_id' => $cartItem->product->id,
            'unit_price' => $cartItem->unitPrice()->amount(),
            'qty' => $cartItem->qty,
            'line_total' => $cartItem->total()->amount(),
        ]);

        $orderProduct->storeOptions($cartItem->options);
    }

    public function attachTax($cartTax)
    {
        $this->taxes()->attach($cartTax->id(), ['amount' => $cartTax->amount()->amount()]);
    }

    public function storeTransaction($response)
    {
        if (is_null($response->getTransactionReference())) {
            return;
        }

        $this->transaction()->create([
            'transaction_id' => $response->getTransactionReference(),
            'payment_method' => $this->getOriginal('payment_method'),
        ]);
    }

}
