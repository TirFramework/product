<?php

namespace Tir\Store\Review\Entities;

use Tir\Crud\Support\Eloquent\CrudModel;
use Tir\Store\Product\Entities\Product;
use Tir\User\Entities\User;

class Review extends CrudModel
{
    //Additional trait insert here


    public static $routeName = 'review';

    protected $fillable = ['name', 'reviewer_id', 'product_id', 'rating', 'reviewer_name', 'comment', 'is_approved'];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_approved' => 'boolean',
    ];


    public function getValidation()
    {
        return [
            'reviewer_name' => 'required',
            'product_id'    => 'required',
            'comment'       => 'required',
            'rating'        => 'required'
        ];
    }


    public function getFields()
    {
        $fields = [
            [
                'name'    => 'basic_information',
                'type'    => 'group',
                'visible' => 'ce',
                'tabs'    => [
                    [
                        'name'    => 'review_information',
                        'type'    => 'tab',
                        'visible' => 'ce',
                        'fields'  => [
                            [
                                'name'    => 'id',
                                'type'    => 'text',
                                'visible' => 'io',
                            ],
                            [
                                'name'    => 'reviewer_name',
                                'type'    => 'text',
                                'visible' => 'ice',
                            ],
                            [
                                'name'     => 'reviewer_id',
                                'type'     => 'relation',
                                'relation' => ['reviewer', 'name'],
                                'visible'  => 'ice',
                            ],
                            [
                                'name'     => 'product_id',
                                'type'     => 'relation',
                                'relation' => ['product', 'name'],
                                'visible'  => 'ice',
                            ],
                            [
                                'name'    => 'comment',
                                'type'    => 'textarea',
                                'visible' => 'ce',
                            ],
                            [
                                'name'    => 'rating',
                                'type'    => 'number',
                                'visible' => 'ice',
                            ],
                            [
                                'name'    => 'is_approved',
                                'type'    => 'select',
                                'data'    => ['1' => trans('attribute::panel.yes'), '0' => trans('attribute::panel.no')],
                                'visible' => 'ce',
                            ],

                        ]
                    ]
                ]
            ]
        ];


        return $fields;}


    //Relations ///////////////////////////////////////////////////////////////////////////////////////////////////////

    public function product()
    {
        return $this->belongsTo(Product::class)->withTrashed();
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }


}
