<?php

namespace Tir\Store\Models;

use Tir\Crud\Models\CrudModel;
use Tir\Store\Models\ProductDescription;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends CrudModel
{
    use SoftDeletes;

    //Additional trait insert here



    //this function generate option for action select in header panel
    public function getActions()
    {
        $actions = [
            'index' =>
            [
                'published' => trans('crud::panel.publish'),
                'unpublished' => trans('crud::panel.unpublish'),
                'draft' => trans('crud::panel.draft'),
                'delete' => trans('crud::panel.delete'),
            ],

            'trash' =>
            [
                'restore' => trans('panel.restore'),
                'fullDelete' => trans('panel.full_delete'),
            ],
        ];
        return $actions;
    }
    

    public function getValidation()
    {
        return [
            // 'name' => 'required',
            // 'status' => 'required',
            // 'password' => 'required',
            // 'email' => "required|unique:users,email,$this->id",
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
                'name'       => 'model',
                'type'       => 'text',
                'visible'    => 'isce',
            ],
            [
                'name'      => 'category_id',
                'display'   => 'category',
                'relation'  => 'category',
                'type'      => 'relation',
                'data'      => [Category::class, 'name'],
                'routeName'  => 'category',
                'visible'   => 'icef',
            ],
            [
                'name'       => 'slug',
                'type'       => 'text',
                'visible'    => 'isce',
            ],
            [
                'name'       => 'stockunit',
                'type'       => 'text',
                'visible'    => 'isce',
            ],
            [
                'name'       => 'location',
                'type'       => 'text',
                'visible'    => 'sce',
            ],
            [
                'name'       => 'image',
                'type'       => 'image',
                'visible'    => 'sce',
            ],
            [
                'name'       => 'shipping',
                'type'       => 'text',
                'visible'    => 'sce',
            ],
            [
                'name'       => 'price',
                'type'       => 'price',
                'visible'    => 'isce',
            ],
            [
                'name'       => 'points',
                'type'       => 'text',
                'visible'    => 'sce',
            ],
            [
                'name'       => 'date_available',
                'type'       => 'date',
                'visible'    => 'sce',
            ],
            [
                'name'       => 'weight',
                'type'       => 'text',
                'visible'    => 'sce',
            ],
            [
                'name'       => 'weight_type_id',
                'type'       => 'text',
                'visible'    => 'sce',
            ],
            [
                'name'       => 'length',
                'type'       => 'text',
                'visible'    => 'sce',
            ],
            [
                'name'       => 'length_type_id',
                'type'       => 'text',
                'visible'    => 'sce',
            ],
            [
                'name'       => 'height',
                'type'       => 'text',
                'visible'    => 'sce',
            ],
            [
                'name'       => 'subtract',
                'type'       => 'number',
                'visible'    => 'sce',
            ],
            [
                'name'       => 'minimum',
                'type'       => 'number',
                'visible'    => 'sce',
            ],
            [
                'name'       => 'sort_order',
                'type'       => 'number',
                'visible'    => 'isce',
            ],
            [
                'name'       => 'status',
                'type'       => 'text',
                'visible'    => 'isce',
            ],
            [
                'name'       => 'viewed',
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
                'routeName'  => 'productDescription',
                'visible'    => 'e',
                'fields'     => [
                        [
                            'name'       => 'product_id',
                            'type'       => 'itemId',
                            'visible'    => 'ce'
                        ],
                        [
                            'name'       => 'name',
                            'type'       => 'text',
                            'visible'    => 'ce'
                        ],
                        [
                            'name'       => 'description',
                            'type'       => 'textarea',
                            'visible'    => 'ce'
                        ],
                        [
                            'name'       => 'tag',
                            'type'       => 'text',
                            'visible'    => 'ce'
                        ],
                        [
                            'name'       => 'meta_title',
                            'type'       => 'text',
                            'visible'    => 'ce'
                        ],
                        [
                            'name'       => 'meta_description',
                            'type'       => 'text',
                            'visible'    => 'ce'
                        ],
                        [
                            'name'       => 'meta_keywords',
                            'type'       => 'text',
                            'visible'    => 'ce'
                        ],
                ]
                   
            ]
        ];

        return json_decode(json_encode($fields));
    }

    public function descriptions()
    {
        return $this->hasMany(ProductDescription::Class,'product_id');
    }

    public function category()
    {
            return $this->belongsTo(Category::class);
    }
    

}
