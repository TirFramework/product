<?php

namespace Tir\Store\Category\Entities;

use Tir\Crud\Entities\CrudModel;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends CrudModel 
{
    //Additional trait insert here
    // use SoftDeletes;
    use Translatable;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_searchable' => 'boolean',
        'is_active' => 'boolean',
    ];

    public static $routeName = 'category';

   protected $fillable = ['name','parent_id', 'slug', 'position', 'is_searchable', 'is_active'];

   public $translatedAttributes = ['name'];



    public function getValidation()
    {
        return [
           // 'name' => 'required',
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
                'translation'   => true,
                'visible'   => 'icef',
            ],
            [
                'name'       => 'slug',
                'type'       => 'text',
                'visible'    => 'isce',
            ],
            // [
            //     'name'       => 'image',
            //     'type'       => 'image',
            //     'visible'    => 'sce',
            // ],
            [
                'name'      => 'parent_id',
                'display'   => 'parent',
                'relation'  => 'parent',
                'type'      => 'relation',
                'data'      => [Category::class, 'name'],
                'visible'   => 'sce',
            ],
            // [
            //     'name'      => 'attribute_groups',
            //     'display'   => 'attribute_groups',
            //     'relation'  => 'attribute_groups',
            //     'type'      => 'relationM',
            //     'data'      => [AttributeGroup::class, 'name'],
            //     'visible'   => 'icef',
            // ],
            [
                'name'       => 'position',
                'type'       => 'number',
                'visible'    => 'isce',
            ],
            [
                'name'       => 'is_active',
                'type'       => 'text',
                'visible'    => 'iscef',
            ],
            [
                'name'       => 'is_searchable',
                'type'       => 'text',
                'visible'    => 'iscef',
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

    // public function products()
    // {
    //         return $this->belongsToMany(Product::class);
    // }

    // public function attribute_groups()
    // {
    //         return $this->belongsToMany(AttributeGroup::class);
    // }

}
