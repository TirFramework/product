<?php

namespace Tir\Store\Category\Entities;

use Astrotomic\Translatable\Translatable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Cache;
use Tir\Crud\Support\Eloquent\CrudModel;
use Tir\Crud\Support\Facades\Crud;
use Tir\Store\Product\Entities\Product;
use TypiCMS\NestableTrait;

class Category extends CrudModel
{

    use Translatable, NestableTrait, Sluggable;


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

   public $with = ['translations'];


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
            'is_searchable' => 'required',
            'is_active'=> 'required',
//            'parent_id' => 'different:id'
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
                                'type'       => 'hidden',
                                'visible'    => 'ieo',

                            ],
                            [
                                'name'      => 'name',
                                'type'      => 'text',
                                'visible'   => 'ice',
                            ],
                            [
                                'name'       => 'slug',
                                'type'       => 'text',
                                'visible'    => 'isce',
                            ],
                            [
                                'name'      => 'parent_id',
                                'display'   => 'parent',
                                'type'      => 'relation',
                                'relation'  => ['parent','name'],
                                'visible'   => 'isce',
                            ],
                            [
                                'name'       => 'position',
                                'type'       => 'position',
                                'visible'    => 'isce',
                            ],
                            [
                                'name'       => 'is_active',
                                'type'       => 'select',
                                'data'       => ['1'=>trans('category::panel.yes'),'0'=>trans('category::panel.no')],
                                'visible'    => 'ce',
                            ],
                            [
                                'name'       => 'is_searchable',
                                'type'       => 'select',
                                'data'       => ['1'=>trans('category::panel.yes'),'0'=>trans('category::panel.no')],
                                'visible'    => 'ce',
                            ]

                        ]
                    ]
                ]

            ]
        ];

        return $fields;}




    //relations ///////////////////////////////////////////////////////////////////////////////////////////////////////

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id')->withDefault();
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class,'product_category');
    }

    //functions ///////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * Get searchable categoires.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function searchable()
    {
        return Cache::tags(['categories'])->rememberForever('categories.searchable:' . Crud::locale(), function () {
            return static::where('is_searchable', true)->get();
        });
    }

    public function isRoot()
    {
        return $this->exists && is_null($this->parent_id);
    }

    /**
     * Returns the public url for the category.
     *
     * @return string
     */
    public function url()
    {
        return route('products.index', ['category' => $this->slug]);
    }

    public static function tree()
    {
        return Cache::tags(['categories'])->rememberForever('categories.tree:' . Crud::locale(), function () {
            return static::orderByRaw('-position DESC')->get()->nest();
        });
    }

    public static function treeList()
    {
        return Cache::tags(['categories'])->rememberForever('categories.tree_list:' . Crud::locale(), function () {
            return static::orderByRaw('-position DESC')
                ->get()
                ->nest()
                ->setIndent('¦–– ')
                ->listsFlattened('name');
        });
    }
}
