<?php

namespace Tir\Store\Product\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Tir\Crud\Support\Eloquent\CrudModel;
use Astrotomic\Translatable\Translatable;
use Tir\Crud\Support\Eloquent\Sluggable;
use Tir\Store\Attribute\Entities\ProductAttribute;
use Tir\Store\Category\Entities\Category;
use Tir\Store\Option\Entities\OptionValue;


class Product extends CrudModel
{
    //Additional trait insert here
    
    use Translatable, Sluggable, SoftDeletes;


    public static $routeName = 'product';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'short_description',
        'tax_class_id',
        'slug',
        'sku',
        'price',
        'special_price',
        'special_price_start',
        'special_price_end',
        'manage_stock',
        'qty',
        'image',
        'in_stock',
        'is_active',
        'new_from',
        'new_to',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'manage_stock' => 'boolean',
        'in_stock' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'special_price_start',
        'special_price_end',
        'new_from',
        'new_to',
        'start_date',
        'end_date',
        'deleted_at',
    ];

    public $translatedAttributes = ['name', 'description', 'short_description'];



    public function getValidation()
    {
        return [
            'name' => 'required',
            'categories' => 'required',
            'slug' => 'required',
            'price' => 'required',
            'description'=>'required'

        ];
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'slug'
            ]
        ];
    }



    public function getFields()
    {
        $fields = [
            [
                'name' => 'basic_information',
                'type' => 'group',
                'visible'    => 'ce',
                'tabs'=>  [
                    [
                        'name'  => 'general',
                        'type'  => 'tab',
                        'visible'    => 'ce',
                        'fields' => [
                            [
                                'name'       => 'id',
                                'type'       => 'text',
                                'visible'    => 'io',
                            ],
                            [
                                'name'      => 'name',
                                'type'      => 'text',
                                'translation'   => true,
                                'visible'   => 'icef',
                            ],
                            [
                                'name'      => 'slug',
                                'type'      => 'text',
                                'visible'   => 'ice',
                            ],
                            [
                                'name'      => 'image',
                                'type'      => 'image',
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'categories',
                                'type'      => 'relationM',
                                'relation'  => 'categories',
                                'data'      => [Category::Class,'name'],
                                'translation'   => true,
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'is_active',
                                'type'      => 'select',
                                'data'      => ['0'=>'no','1'=>'yes'],
                                'visible'   => 'cef',
                            ],
                            [
                                'name'      => 'description',
                                'type'      => 'textarea',
                                'col'       => 'col-md-12',
                                'translation'   => true,
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'sku',
                                'display'   => 'SKU',
                                'type'      => 'text',
                                'visible'   => 'ce',
                            ],
                        ]
                    ],
                    [
                        'name'  => 'price',
                        'type'  => 'tab',
                        'visible'    => 'ce',
                        'fields' => [
                            [
                                'name'      => 'price',
                                'type'      => 'price',
                                'visible'   => 'ice',
                            ],
                            [
                                'name'      => 'special_price',
                                'type'      => 'price',
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'special_price_start',
                                'type'      => 'date',
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'special_price_end',
                                'type'      => 'date',
                                'visible'   => 'ce',
                            ]
                        ]
                    ],
                    [
                        'name'  => 'inventory',
                        'type'  => 'tab',
                        'visible'    => 'ce',
                        'fields' => [
                            [
                                'name'      => 'manage_stock',
                                'type'      => 'select',
                                'data'      => ['0'=>'Don\'t Track Inventory','1'=>'Track Inventory'],
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'qty',
                                'type'      => 'number',
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'in_stock',
                                'type'      => 'select',
                                'data'      => ['1'=>'In Stock','0'=>'Out of Stock'],
                                'visible'   => 'ce',
                            ]
                        ]
                    ]
                ]
            ],
            [
                'name' => 'advance_information',
                'type' => 'group',
                'visible'    => 'ce',
                'tabs' => [
                    [
                        'name'  => 'attributes',
                        'type'  => 'tab',
                        'visible'    => 'ce',
                        'fields' => [
                            [
                                'name'      => 'attributes',
                                'type'      => 'attributes',
                                'visible'   => 'ce',
                            ],
                        ],
                    ],
                    [
                        'name'  => 'options',
                        'type'  => 'tab',
                        'visible'    => '',
                        'fields' => [],
                    ]

                ]
            ]

        ];



        return json_decode(json_encode($fields));
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class,'product_category')->orderBy('position');
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function getPriceAttribute($value)
    {
        return floor($value);
    }


    }
