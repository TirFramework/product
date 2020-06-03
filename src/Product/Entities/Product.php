<?php

namespace Tir\Store\Product\Entities;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tir\Crud\Support\Eloquent\CrudModel;
use Astrotomic\Translatable\Translatable;
use Tir\Store\Attribute\Entities\ProductAttribute;
use Tir\Store\Category\Entities\Category;
use Tir\Store\Option\Entities\Option;
use Tir\Store\Product\Support\Price;
use Tir\Store\Review\Entities\Review;
use Tir\Store\Search\Searchable;


class Product extends CrudModel
{
    //Additional trait insert here

    use Translatable, Sluggable, softDeletes, Searchable;


    public static $routeName = 'product';

    public $with = ['translations'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'short_description',
        'tax_class_id',
        'slug',
        'sku',
        'price',
        'special_price',
        'special_price_start',
        'special_price_end',
        'manage_stock',
        'qty',
        'image',
        'in_stock',
        'is_active',
        'new_from',
        'new_to',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'manage_stock' => 'boolean',
        'in_stock'     => 'boolean',
        'is_active'    => 'boolean',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'special_price_start',
        'special_price_end',
        'new_from',
        'new_to',
        'start_date',
        'end_date',
        'deleted_at',
    ];

    public $translatedAttributes = ['name', 'description', 'short_description'];


    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($product) {
            $product->selling_price = $product->getSellingPrice();
        });

//        static::saved(function ($product) {
//            if (! empty(request()->all())) {
//                $product->saveRelations(request()->all());
//            }
//        });

//        static::addActiveGlobalScope();
    }


    public function getValidation()
    {
        return [
            'name'        => 'required',
            'categories'  => 'required',
            'slug'        => "required|unique:products,slug,$this->id",
            'price'       => 'required',
            'description' => 'required'

        ];
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'slug'
            ]
        ];
    }


    public function getFields()
    {
        $fields = [
            [
                'name'    => 'basic_information',
                'type'    => 'group',
                'visible' => 'ce',
                'tabs'    => [
                    [
                        'name'    => 'general',
                        'type'    => 'tab',
                        'visible' => 'ce',
                        'fields'  => [
                            [
                                'name'    => 'id',
                                'type'    => 'text',
                                'visible' => 'io',
                            ],
                            [
                                'name'       => 'name',
                                'type'       => 'text',
                                'validation' => 'required',
                                'visible'    => 'ice',
                            ],
                            [
                                'name'    => 'slug',
                                'type'    => 'text',
                                'visible' => 'ice',
                            ],
                            [
                                'name'    => 'image',
                                'type'    => 'image',
                                'visible' => 'ce',
                            ],

                            [
                                'name'     => 'categories',
                                'type'     => 'relationM',
                                'relation' => ['categories', 'name'],
                                'visible'  => 'ice',
                            ],
                            [
                                'name'    => 'is_active',
                                'type'    => 'select',
                                'data'    => ['1' => trans("product::panel.yes"), '0' => trans("product::panel.no")],
                                'visible' => 'cef',
                            ],
                            [
                                'name'       => 'description',
                                'type'       => 'textEditor',
                                'validation' => 'required',
                                'col'        => 'col-md-12',
                                'visible'    => 'ce',
                            ],
                            [
                                'name'    => 'sku',
                                'display' => 'SKU',
                                'type'    => 'text',
                                'visible' => 'ce',
                            ],
                        ]
                    ],
                    [
                        'name'    => 'images',
                        'type'    => 'tab',
                        'visible' => 'ice',
                        'fields'  => [
                            [
                                'name' => 'images',
                                'type' => 'images',
                                'visible' => 'ce'
                            ]
                        ]
                    ],
                    [
                        'name'    => 'price',
                        'type'    => 'tab',
                        'visible' => 'ice',
                        'fields'  => [
                            [
                                'name'    => 'price',
                                'type'    => 'price',
                                'visible' => 'ce',
                            ],
                            [
                                'name'    => 'special_price',
                                'type'    => 'price',
                                'visible' => 'ce',
                            ],
                            [
                                'name'    => 'special_price_start',
                                'type'    => 'date',
                                'visible' => 'ce',
                            ],
                            [
                                'name'    => 'special_price_end',
                                'type'    => 'date',
                                'visible' => 'ce',
                            ]
                        ]
                    ],
                    [
                        'name'    => 'inventory',
                        'type'    => 'tab',
                        'visible' => 'ce',
                        'fields'  => [
                            [
                                'name'    => 'manage_stock',
                                'type'    => 'select',
                                'data'    => ['0' => 'Don\'t Track Inventory', '1' => 'Track Inventory'],
                                'visible' => 'ce',
                            ],
                            [
                                'name'    => 'qty',
                                'type'    => 'number',
                                'visible' => 'ce',
                            ],
                            [
                                'name'    => 'in_stock',
                                'type'    => 'select',
                                'data'    => ['1' => 'In Stock', '0' => 'Out of Stock'],
                                'visible' => 'ce',
                            ]
                        ]
                    ]
                ]
            ],
            [
                'name'    => 'advance_information',
                'type'    => 'group',
                'visible' => 'ce',
                'tabs'    => [
                    [
                        'name'    => 'attributes',
                        'type'    => 'tab',
                        'visible' => 'ce',
                        'fields'  => [
                            [
                                'name'    => 'attributes',
                                'type'    => 'attributes',
                                'visible' => 'ce',
                            ],
                        ],
                    ],
                    [
                        'name'    => 'options',
                        'type'    => 'tab',
                        'visible' => '',
                        'fields'  => [],
                    ]

                ]
            ]

        ];


        return json_decode(json_encode($fields));
    }

    //Additional methods //////////////////////////////////////////////////////////////////////////////////////////////

    //Scopes
    public function scopeForCard($query)
    {
        $query->withName()
//            ->withBaseImage()
            ->withPrice()
            ->withCount('options')
            ->addSelect([
                'image',
                'products.id',
                'slug',
                'in_stock',
                'new_from',
                'new_to',
            ]);
    }

    public function scopeWithName($query)
    {
        $query->with('translations:id,product_id,locale,name');
    }

    public function scopeWithBaseImage($query)
    {
        $query->with(['files' => function ($q) {
            $q->wherePivot('zone', 'base_image');
        }]);
    }

    public function scopeWithPrice($query)
    {
        $query->addSelect([
            'price',
            'special_price',
            'selling_price',
            'special_price_start',
            'special_price_end',
        ]);
    }

    //Additional helper methods ///////////////////////////////////////////////////////////////////////////////////////

    public static function findBySlug($slug)
    {
        return static::with([
            'attributes.attribute.attribute_set','additionalImages',
        ])->where('slug', $slug)->firstOrFail();
    }

    //Attributes
    public function hasAnyAttribute()
    {
        return $this->getAttribute('attributes')->isNotEmpty();
    }

    public function hasAttribute($attribute)
    {
        return $this->getAttribute('attributes')->contains('name', $attribute->name);
    }

    public function attributeValues($attribute)
    {
        return $this->getAttribute('attributes')
            ->where('name', $attribute->name)
            ->first()
            ->values
            ->implode('value', ', ');
    }

    public function options()
    {
        return $this->belongsToMany(Option::class, 'product_options')
            ->orderBy('position')
            ->withTrashed();
    }

    public function isOutOfStock()
    {
        return !$this->isInStock();
    }

    public function isInStock()
    {
        return $this->in_stock;
    }

    public function outOfStock()
    {
        $this->update(['in_stock' => false]);
    }

    public function hasStockFor($qty)
    {
        if (! $this->manage_stock) {
            return true;
        }

        return $this->qty >= $qty;
    }


    //isNew & related private method
    public function isNew()
    {
        if ($this->hasNewFromDate() && $this->hasNewToDate()) {
            return $this->newFromDateIsValid() && $this->newToDateIsValid();
        }

        if ($this->hasNewFromDate()) {
            return $this->newFromDateIsValid();
        }

        if ($this->hasNewToDate()) {
            return $this->newToDateIsValid();
        }

        return false;
    }

    private function hasNewFromDate()
    {
        return !is_null($this->new_from);
    }

    private function hasNewToDate()
    {
        return !is_null($this->new_to);
    }

    private function newFromDateIsValid()
    {
        return today() >= $this->new_from;
    }

    private function newToDateIsValid()
    {
        return today() <= $this->new_to;
    }

    //SpecialPrice & related private method

    public function hasSpecialPrice()
    {
        if (is_null($this->special_price)) {
            return false;
        }

        if ($this->hasSpecialPriceStartDate() && $this->hasSpecialPriceEndDate()) {
            return $this->specialPriceStartDateIsValid() && $this->specialPriceEndDateIsValid();
        }

        if ($this->hasSpecialPriceStartDate()) {
            return $this->specialPriceStartDateIsValid();
        }

        if ($this->hasSpecialPriceEndDate()) {
            return $this->specialPriceEndDateIsValid();
        }

        return true;
    }

    private function hasSpecialPriceStartDate()
    {
        return !is_null($this->special_price_start);
    }

    private function hasSpecialPriceEndDate()
    {
        return !is_null($this->special_price_end);
    }

    private function specialPriceStartDateIsValid()
    {
        return today() >= $this->special_price_start;
    }

    private function specialPriceEndDateIsValid()
    {
        return today() <= $this->special_price_end;
    }

    //Reviews
    public function avgRating()
    {
        return ceil($this->reviews->avg->rating * 2) / 2;
    }

    public function totalReviewsForRating($rating)
    {
        return $this->reviews->where('rating', $rating)->count();
    }

    public function percentageReviewsForStar($rating)
    {
        $totalReviews = $this->reviews->count();

        if ($totalReviews === 0) {
            return 0;
        }

        $reviewsCount = $this->totalReviewsForRating($rating);

        return round($reviewsCount / $totalReviews * 100);
    }


    public function filter($filter)
    {
        return $filter->apply($this);
    }


    //Mutators & Accessors ////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * Get the selling price of the product.
     *
     * @return int
     */
    public function getSellingPrice()
    {
        if ($this->hasSpecialPrice()) {
            return $this->special_price;
        }

        return $this->price;
    }

    public function getPriceAttribute($price)
    {
        return $price;
    }

    public function getSpecialPriceAttribute($specialPrice)
    {
        if (!is_null($specialPrice)) {
            //return Money::inDefaultCurrency($specialPrice);
            return $specialPrice;
        }
    }

    public function getSellingPriceAttribute($sellingPrice)
    {
        //return Money::inDefaultCurrency($sellingPrice);
        return $sellingPrice;
    }

    public function getTotalAttribute($total)
    {
//        return Money::inDefaultCurrency($total);
        return $total;
    }


    public function getAttributeSetsAttribute()
    {
        return $this->getAttribute('attributes')->groupBy('attribute_set');
    }

    //Search //////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Get the indexable data array for the product.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        // MySQL Full-Text search handles indexing automatically.
        if (config('scout.driver') === 'mysql') {
            return [];
        }

        $translations = $this->translations()
            ->withoutGlobalScope('locale')
            ->get(['name', 'description', 'short_description']);

        return ['id' => $this->id, 'translations' => $translations];
    }

    public function searchTable()
    {
        return 'product_translations';
    }

    public function searchKey()
    {
        return 'product_id';
    }

    public function searchColumns()
    {
        return ['name'];
    }

    //Relations ///////////////////////////////////////////////////////////////////////////////////////////////////////

    public function additionalImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category')->orderBy('position');
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }


}
