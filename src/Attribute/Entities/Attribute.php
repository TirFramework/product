<?php

namespace Tir\Store\Attribute\Entities;

use Tir\Crud\Support\Eloquent\CrudModel;
use Tir\Crud\Support\Eloquent\Translatable;
use Tir\Store\Category\Entities\Category;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends CrudModel
{
    //Additional trait insert here
    
    // use SoftDeletes;
    use Translatable;


    public static $routeName = 'attribute';

    protected $fillable = ['name', 'is_filterable','attribute_set_id'];

    protected $with = ['translations'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_filterable' => 'boolean',
    ];



   public $translatedAttributes = ['name'];



    public function getValidation()
    {
        return [
            'name' => 'required',
            'attribute_set_id' => 'required',
            'is_filterable' => 'required',
            'values.*.value'      => 'required'
        ];
    }
    

    public function getFields()
    {
        $fields = [
            [
                'name' => 'basic-information',
                'type' => 'group',
                'visible'    => 'ce',
                'tabs'=>  [
                    [
                        'name'  => 'attribute-information',
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
                                'visible'   => 'icef',
                            ],
                            [
                                'name'      => 'attribute_set_id',
                                'display'   => 'attribute_set',
                                'type'      => 'relation',
                                'relation'  => ['attribute_set', 'name'],
                                'visible'   => 'icef',
                            ],
                            [
                                'name'      => 'is_filterable',
                                'type'      => 'select',
                                'data'       => ['1'=>trans('attribute::panel.yes'),'0'=>trans('attribute::panel.no')],
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'categories',
                                'type'      => 'relationM',
                                'relation'  => ['categories', 'name'],
                                'visible'   => 'cef',
                            ]

                        ]
                    ],
                    [
                        'name'  => 'values',
                        'type'   => 'tab',
                        'visible' => 'ce',
                        'fields'  => [
                            [
                                'name'      => 'values',
                                'type'      => 'attributeValues',
                                'visible'   => 'ce',
                            ]
                        ]
                    ]
                ]
            ]
        ];


        return $fields;}


    public function values()
    {
        return $this->hasMany(AttributeValue::class)->orderBy('position');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)->orderBy('position');
    }

    public function attribute_set()
    {
        return $this->belongsTo(AttributeSet::class);
    }


}
