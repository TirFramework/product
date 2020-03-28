<?php

namespace Tir\Store\Models;

use Tir\Crud\Models\CrudModel;
use Tir\Store\Models\AttributeGroup;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends CrudModel
{
    //Additional trait insert here

    use SoftDeletes;


    public static $routeName = 'attribute';


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
                'name'      => 'attribute_group_id',
                'display'   => 'attribute_group',
                'type'      => 'relation',
                'relation'  => 'attribute_group',
                'data'      => [AttributeGroup::Class, 'name'],
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
                'routeName'  => 'attributeDescription',
                'visible'    => 'ie',
                'fields'     => [
                        [
                            'name'       => 'attribute_id',
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

    public function attribute_group()
    {
            return $this->belongsTo(AttributeGroup::class,'attribute_group_id');
    }       

    public function descriptions()
    {
            return $this->hasMany(AttributeDescription::class,'attribute_id');
    }       
}
