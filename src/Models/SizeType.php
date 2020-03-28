<?php

namespace Tir\Store\Models;

use Tir\Crud\Models\CrudModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class SizeType extends CrudModel
{
    
    //Additional trait insert here
    
    use SoftDeletes;

    public $table = 'size_types';
    public static $routeName = 'sizeType';

   

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
                'routeName'  => 'sizeTypeDescription',
                'visible'    => 'e',
                'fields'     => [
                    [
                        'name'       => 'size_type_id',
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
        return $this->hasMany(SizeTypeDescription::Class,'size_type_id');
    }

  

}
