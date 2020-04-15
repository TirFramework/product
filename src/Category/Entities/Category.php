<?php

namespace Tir\Store\Category\Entities;

use Astrotomic\Translatable\Translatable;
use Cviebrock\EloquentSluggable\Sluggable;
use Tir\Crud\Support\Eloquent\CrudModel;

class Category extends CrudModel 
{
    //Additional trait insert here

    use Translatable;
    use Sluggable;


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

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'slug'
            ]
        ];
    }

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
                'name'  =>  'basic-information',
                'type'  =>   'group',
                'visible' => 'ce',
                'tabs' => [
                    [
                        'name'  => 'general',
                        'type' => 'tab',
                        'visible' => 'ce',
                        'fields' => [
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
                                'visible'   => 'sce',
                            ],
                            [
                                'name'       => 'position',
                                'type'       => 'position',
                                'visible'    => 'isce',
                            ],
                            [
                                'name'       => 'is_active',
                                'type'       => 'select',
                                'data'       => ['1'=>trans('product::panel.yes'),'0'=>trans('product::panel.no')],
                                'visible'    => 'ce',
                            ],
                            [
                                'name'       => 'is_searchable',
                                'type'       => 'select',
                                'data'       => ['1'=>trans('product::panel.yes'),'0'=>trans('product::panel.no')],
                                'visible'    => 'ce',
                            ]

                        ]
                    ]
                ]

            ]
        ];

        return json_decode(json_encode($fields));
    }



    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

}
