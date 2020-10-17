<?php

namespace Tir\Store\Transaction\Entities;


use Illuminate\Database\Eloquent\SoftDeletes;
use Tir\Crud\Support\Eloquent\CrudModel;
use Tir\Store\Payment\Gateway;

class Transaction extends CrudModel
{
    use SoftDeletes;


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array',
    ];

    public static $routeName = 'transaction';


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    public function getFields()
    {
        return [
            [
                'name'    => 'basic_information',
                'type'    => 'group',
                'visible' => 'ce',
                'tabs'    => [
                    [
                        'name'    => 'transaction_information',
                        'type'    => 'tab',
                        'visible' => 'ce',
                        'fields'  => [
                            [
                                'name'    => 'id',
                                'type'    => 'text',
                                'option'  => 'readonly',
                                'visible' => 'io',
                            ],
                            [
                                'name'    => 'order_id',
                                'type'    => 'text',
                                'option'  => 'readonly',
                                'visible' => 'ie'
                            ],
                            [
                                'name'    => 'transaction_id',
                                'type'    => 'text',
                                'option'  => 'readonly',
                                'visible' => 'ie'
                            ],
                            [
                                'name'    => 'payment_method',
                                'type'    => 'text',
                                'option'  => 'readonly',
                                'visible' => 'ie'
                            ],
                            [
                                'name'    => 'status',
                                'type'    => 'text',
                                'option'  => 'readonly',
                                'visible' => 'ief'
                            ],
                            [
                                'name'    => 'created_at',
                                'type'    => 'text',
                                'option'  => 'readonly',
                                'visible' => 'ie',
                            ],
                            [
                                'name'    => 'paid_at',
                                'type'    => 'text',
                                'option'  => 'readonly',
                                'visible' => 'ie',
                            ],

                        ]
                    ]

                ]
            ]
        ];


    }

    public function getCreatedAtAttribute($date)
    {
        return jdate($date)->format('Y/m/d H:m');
    }

    public function getPaidAtAttribute($date)
    {
        if(isset($date)){
            return jdate($date)->format('Y/m/d H:m');
        }

        return null;
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }


}
