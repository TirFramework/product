<?php

namespace Tir\Store\Models;

use Tir\Crud\Models\CrudModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends CrudModel
{
    //Additional trait insert here
    use SoftDeletes;

    public static $routeName = 'category';



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
                'visible'    => 'iscef',
            ],
            [
                'name'       => 'slug',
                'type'       => 'text',
                'visible'    => 'isce',
            ],
            [
                'name'       => 'image',
                'type'       => 'image',
                'visible'    => 'sce',
            ],
            [
                'name'      => 'parent_id',
                'display'   => 'parent',
                'relation'  => 'parent',
                'type'      => 'relation',
                'data'      => [Category::class, 'name'],
                'routeName'  => 'category',
                'visible'   => 'icef',
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
           
        ];

        return json_decode(json_encode($fields));
    }


    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products()
    {
            return $this->belongsToMany(Product::class);
    }
    

}
