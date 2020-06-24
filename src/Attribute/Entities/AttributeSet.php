<?php

namespace Tir\Store\Attribute\Entities;

use Tir\Crud\Support\Eloquent\CrudModel;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttributeSet extends CrudModel 
{
    //Additional trait insert here
    
    // use SoftDeletes;
    use Translatable;


    public $table = 'attribute_sets';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_searchable' => 'boolean',
        'is_active' => 'boolean',
    ];

    public static $routeName = 'attributeSet';

   protected $fillable = ['name'];

   public $translatedAttributes = ['name'];



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
                'name' => 'basic_information',
                'type' => 'group',
                'visible'    => 'ce',
                'tabs'=>  [
                    [
                        'name'  => 'main_info',
                        'type'  => 'tab',
                        'visible'    => 'ce',
                        'fields' => [
                            [
                                'name'       => 'id',
                                'type'       => 'text',
                                'visible'    => 'io',
                            ],
                            [
                                'name'      => 'name',
                                'type'      => 'text',
                                'visible'   => 'icef',
                            ]
                        ]
                    ]
                ]
            ]

        ];

        return $fields;}


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

    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }

}
