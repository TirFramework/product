<?php

namespace Tir\Store\Attribute\Entities;

use Tir\Crud\Entities\CrudModel;
use Astrotomic\Translatable\Translatable;
use Tir\Store\Category\Entities\Category;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends CrudModel 
{
    //Additional trait insert here
    
    // use SoftDeletes;
    use Translatable;


    public static $routeName = 'attribute';

    protected $fillable = ['name', 'is_filterable','attribute_set_id'];


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
               'name'      => 'attribute_set_id',
               'display'   => 'attribute_set',
               'relation'  => 'attributeSet',
               'type'      => 'relation',
               'data'      => [AttributeSet::class, 'name'],
               'col'       => 'col-md-4',
               'visible'   => 'cef',
           ],
           [
            'name'      => 'is_filterable',
            'type'      => 'select',
            'data'      => ['0'=>'no','1'=>'yes'],
            'col'       => 'col-md-4',
            'visible'   => 'cef',
           ],
           [
            'name'      => 'categories',
            'type'      => 'relationM',
            'relation'  => 'categories',
            'data'      => [Category::Class,'name'],
            'translation'   => true,
            'col'       => 'col-md-4',
            'visible'   => 'cef',
           ],
           [
            'name'      => 'values',
            'relation'  => 'values',
            'type'      => 'attributeValues',
            'visible'   => 'ce',
           ]
        ];

        return json_decode(json_encode($fields));
    }

    public function values()
    {
        return $this->hasMany(AttributeValue::class)->orderBy('position');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)->orderBy('position');
    }


}
