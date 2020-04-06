<?php

namespace Tir\Store\Models;

use Tir\Crud\Models\CrudModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends CrudModel
{
    //Additional trait insert here

    use SoftDeletes;


    public static $routeName = 'option';


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
                'visible'    => 'i',
            ],
            [
                'name'       => 'name',
                'type'       => 'text',
                'visible'    => 'isce',
            ],
            [
                'name'       => 'sort_order',
                'type'       => 'order',
                'visible'    => 'isceo',
            ],
            [
                'name'       => 'type',
                'type'       => 'text',
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
                'key'        => 'option_id',
                'routeName'  => 'optionDescription',
                'visible'    => 'ie',
                'fields'     => [
                        [
                            'name'       => 'title',
                            'type'       => 'text',
                            'visible'    => 'ce'
                        ]
                ]
                   
            ],
            [
                'name'       => 'type',
                'type'       => 'optionType',
                'visible'    => 'e',
            ],

        ];

        return json_decode(json_encode($fields));
    }
  

    public function descriptions()
    {
            return $this->hasMany(OptionDescription::class,'option_id');
    }       
}
