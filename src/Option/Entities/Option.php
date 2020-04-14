<?php

namespace Tir\Store\Option\Entities;

use Tir\Crud\Support\Eloquent\CrudModel;
use Astrotomic\Translatable\Translatable;
use Tir\Store\Attribute\Entities\AttributeSet;
use Tir\Store\Category\Entities\Category;


class Option extends CrudModel
{
    //Additional trait insert here
    
    use Translatable;


    public static $routeName = 'option';

    protected $fillable = ['name', 'type' ,'is_required','position'];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_required' => 'boolean',
    ];



   public $translatedAttributes = ['name'];



    public function getValidation()
    {
        return [
            'name' => 'required',
            'type' => 'required',
            'is_required' => 'required',
            'values.*.label' => 'required',
            'values.*.price' => 'required',
            'values.*.price_type' => 'required',

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
                                'name'      => 'type',
                                'type'      => 'select',
                                'data'      => ['dropdown'=>'Dropdown',
                                                'checkbox'=>'Checkbox',
                                                'radio'=>'Radio Button',
                                                'multiple_select'=>'Multiple Select'],
                                'visible'   => 'cef',
                            ],
                            [
                                'name'      => 'is_required',
                                'type'      => 'select',
                                'data'      => ['0'=>'no','1'=>'yes'],
                                'visible'   => 'cef',
                            ]
                        ]
                    ],
                    [
                        'name'  => 'values',
                        'type' => 'tab',
                        'visible' => 'ce',
                        'fields'   => [
                            [
                                'name'      => 'values',
                                'relation'  => 'values',
                                'type'      => 'optionValues',
                                'visible'   => 'ce',
                            ]
                        ]
                    ]
                ]
            ]
        ];

        return json_decode(json_encode($fields));
    }

        public function values()
    {
        return $this->hasMany(OptionValue::class)->orderBy('position');
    }

}
