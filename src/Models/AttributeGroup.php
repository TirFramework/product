<?php

namespace Tir\Store\Models;

use Tir\Crud\Models\CrudModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttributeGroup extends CrudModel
{
    //Additional trait insert here

    use SoftDeletes;

    public $table = 'attribute_groups';

    public static $routeName = 'attributeGroup';


    public function getValidation()
    {
        return [
            'name' => 'required',
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
                'name'       => 'name',
                'type'       => 'text',
                'visible'    => 'isce',
            ],
            [
                'name'       => 'sort_order',
                'type'       => 'number',
                'visible'    => 'isce',
            ],

           
        ];

        return json_decode(json_encode($fields));
    }

    public function getAdditionalFields()
    {
        $fields = [
            [
                'name'       => 'descriptions',
                'type'       => 'multiLanguage',
                'relation'   => 'descriptions',
                'key'        => 'attribute_group_id',
                'routeName'  => 'attributeGroupDescription',
                'visible'    => 'ie',
                'fields'     => [
                        [
                            'name'       => 'attribute_group_id',
                            'type'       => 'itemId',
                            'visible'    => 'ce'
                        ],
                        [
                            'name'       => 'title',
                            'type'       => 'text',
                            'visible'    => 'ce'
                        ]
                ]
                   
            ]
        ];

        return json_decode(json_encode($fields));
    }

    public function descriptions()
    {
            return $this->hasMany(AttributeGroupDescription::class,'attribute_group_id');
    }
    
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function attributes()
    {
        return $this->hasMany(Attribute::Class);
    }
}
