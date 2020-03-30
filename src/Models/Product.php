<?php

namespace Tir\Store\Models;

use Tir\Crud\Models\CrudModel;
use Tir\Store\Models\WeightType;
use Tir\Store\Models\ProductDescription;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends CrudModel
{
    
    //Additional trait insert here
    
    
    use SoftDeletes;

    protected $guarded = ['id', 'categories' ,'save_close', 'save_edit'];

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
                'name'      => 'categories',
                'display'   => 'categories',
                'relation'  => 'categories',
                'type'      => 'relationM',
                'data'      => [Category::class, 'name'],
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
                'type'      => 'relation',
                'relation'  => 'weightType',
                'data'      => [WeightType::class, 'name'],
                'visible'   => 'ce',
            ],
            [
                'name'       => 'length',
                'type'       => 'text',
                'visible'    => 'sce',
            ],
            [
                'name'       => 'width',
                'type'       => 'text',
                'visible'    => 'sce',
            ],
            [
                'name'       => 'height',
                'type'       => 'text',
                'visible'    => 'sce',
            ],
            [
                'name'       => 'size_type_id',
                'type'      => 'relation',
                'relation'  => 'sizeType',
                'data'      => [SizeType::class, 'name'],
                'visible'   => 'ce',
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
                'type'       => 'order',
                'visible'    => 'isce',
            ],
            [
                'name'       => 'status',
                'type'       => 'text',
                'visible'    => 'iscef',
            ],
            [
                'name'       => 'viewed',
                'type'       => 'text',
                'visible'    => 'sce',
            ],  
        ];

        return json_decode(json_encode($fields));
    }

    public function getAdditionalFields()
    {
        $fields = [
            
            [
                'name'      => 'attributes',
                'type'      => 'attributes',
                'visible'   => 'e'
            ],
            [
                
                'name'       => 'descriptions',
                'type'       => 'multiLanguage',
                'relation'   => 'descriptions',
                'key'        => 'product_id',
                'routeName'  => 'productDescription',
                'visible'    => 'e',
                'fields'     => [
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
                    ],
                   
            ]
        ];

        return json_decode(json_encode($fields));
    }

    public static function getCategoryAttributes($id)
    {
       return \DB::table('products')
                    ->join('category_product', 'products.id', '=', 'category_product.product_id')
                    ->join('categories', 'categories.id', '=', 'category_product.category_id')
                    ->join('attribute_group_category', 'categories.id', '=', 'attribute_group_category.category_id')
                    ->join('attribute_groups', 'attribute_groups.id', '=', 'attribute_group_category.attribute_group_id')
                    ->join('attributes', 'attributes.attribute_group_id', '=', 'attribute_group_category.attribute_group_id')
                    ->where('products.id','=',$id)
                    ->select('attributes.id' , 'attributes.name')
                    ->distinct()
                    ->get();
    }

    public function descriptions()
    {
        return $this->hasMany(ProductDescription::Class,'product_id');
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::Class)->withPivot('value','language_id');
        //return $this->belongsToMany(Attribute::Class);
    }

    public function categories()
    {
            return $this->belongsToMany(Category::class);
    }

    public function weightType()
    {
            return $this->belongsTo(weightType::class);
    }

    public function sizeType()
    {
            return $this->belongsTo(sizeType::class);
    }
    

}
