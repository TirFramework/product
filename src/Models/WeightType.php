<?php

namespace Tir\Store\Models;

use Tir\Crud\Models\CrudModel;

class WeightType extends CrudModel
{
    
    //Additional trait insert here
    

    public $table = 'weight_types';
   

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
            ]           
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
                'routeName'  => 'weightTypeDescription',
                'visible'    => 'e',
                'fields'     => [
                    [
                        'name'       => 'weight_type_id',
                        'type'       => 'itemId',
                        'visible'    => 'ce'
                    ],
                    [
                        'name'       => 'title',
                        'type'       => 'text',
                        'visible'    => 'ce'
                    ],
                    [
                        'name'       => 'unit',
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
        return $this->hasMany(WeightTypeDescription::Class,'weight_type_id');
    }

  

}
