<?php

namespace Tir\Store\Brand\Entities;

use Astrotomic\Translatable\Translatable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Tir\Crud\Support\Eloquent\CrudModel;
use Tir\Crud\Support\Facades\Crud;
use Tir\Store\Category\Entities\Category;
use Tir\Store\Product\Entities\Product;
use TypiCMS\NestableTrait;

class Brand extends CrudModel
{
    //Additional trait insert here

    use Translatable, NestableTrait;

    // use Sluggable;


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static $routeName = 'brand';

    protected $fillable = ['name', 'parent_id', 'slug','logo','image', 'position', 'is_active', 'description'];

    public $translatedAttributes = ['name', 'description'];

    public $with = ['translations'];


    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'slug'
            ]
        ];
    }

    public function getValidation()
    {
        return [
            'name'      => 'required',
            'slug'      => 'required',
            'is_active' => 'required'
        ];
    }


    public function getFields()
    {
        return [
            [
                'name'    => 'basic-information',
                'type'    => 'group',
                'visible' => 'ce',
                'tabs'    => [
                    [
                        'name'    => 'general',
                        'type'    => 'tab',
                        'visible' => 'ce',
                        'fields'  => [
                            [
                                'name'    => 'id',
                                'type'    => 'text',
                                'visible' => 'io',
                            ],
                            [
                                'name'    => 'name',
                                'type'    => 'text',
                                'visible' => 'ice',
                            ],
                            [
                                'name'    => 'slug',
                                'type'    => 'text',
                                'visible' => 'isce',
                            ],
//                            [
//                                'name'     => 'categories',
//                                'type'     => 'relationM',
//                                'relation' => ['categories', 'name'],
//                                'visible'  => 'ce',
//                            ],
                            [
                                'name'    => 'image',
                                'type'    => 'image',
                                'visible' => 'sce',
                            ],
                            [
                                'name'    => 'logo',
                                'type'    => 'image',
                                'visible' => 'sce',
                            ],
                            [
                                'name'    => 'position',
                                'type'    => 'position',
                                'visible' => 'isce',
                            ],
                            [
                                'name'    => 'is_active',
                                'type'    => 'select',
                                'data'    => ['1' => trans('brand::panel.yes'), '0' => trans('brand::panel.no')],
                                'visible' => 'ce',
                            ],
                            [
                                'name'    => 'description',
                                'type'    => 'textEditor',
                                'visible' => 'sce',
                            ],

                        ]
                    ]
                ]

            ]
        ];

    }


    //relations ///////////////////////////////////////////////////////////////////////////////////////////////////////

/*    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }*/

    public function products()
    {
        return $this->HasMany(Product::class);
    }


    //functions ///////////////////////////////////////////////////////////////////////////////////////////////////////

    public function is_filtering()
    {
        $requestQueries = Arr::flatten(request('brands', []));

        return in_array($this->id, $requestQueries);
    }
}
