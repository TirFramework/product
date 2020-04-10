<?php

namespace Tir\Store\Option\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Tir\Crud\Support\Eloquent\CrudModel;
use Astrotomic\Translatable\Translatable;
use Tir\Store\Option\Entities\OptionValue;


class Product extends CrudModel
{
    //Additional trait insert here
    
    use Translatable, SoftDeletes, Sluggable;


    public static $routeName = 'option';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tax_class_id',
        'slug',
        'sku',
        'price',
        'special_price',
        'special_price_start',
        'special_price_end',
        'manage_stock',
        'qty',
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
