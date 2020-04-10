<?php

namespace Tir\Store\Option\Entities;

use Tir\Crud\Support\Eloquent\CrudModel;
use Astrotomic\Translatable\Translatable;


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
        ];
    }
    


    public function getFields()
    {
        $fields = [
            [
                'name'       => 'id',
                'type'       => 'text',
                'visible'    => 'io',
            ],
            [
                'name'      => 'name',
                'type'      => 'text',
                'col'       => 'col-md-4',
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
                'col'       => 'col-md-4',
                'visible'   => 'cef',
            ],
           [
            'name'      => 'is_required',
            'type'      => 'select',
            'data'      => ['0'=>'no','1'=>'yes'],
            'col'       => 'col-md-4',
            'visible'   => 'cef',
           ],
           [
            'name'      => 'values',
            'relation'  => 'values',
            'type'      => 'optionValues',
            'visible'   => 'ce',
           ]
        ];

        return json_decode(json_encode($fields));
    }

        public function values()
    {
        return $this->hasMany(OptionValue::class)->orderBy('position');
    }

}
