<?php


namespace Tir\Store\Product\Controllers;


use Illuminate\Routing\Controller;
use Tir\Setting\Facades\Stg;
use Tir\Store\Product\Entities\Product;

class ProductController extends Controller
{


    /**
     * @param $slug string
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($slug)
    {
        $product = Product::findBySlug($slug);
        //TODO: add related product
        $relatedProducts = collect();
        //TODO: add upSell product
        $upSellProducts = collect();
        $reviews = $this->getReviews($product);

        if (Stg::get('reviews_enabled')) {
            $product->load('reviews:product_id,rating');
        }
        //TODO: check event
       // event(new ProductViewed($product));

        return view('storefront::public.products.show', compact('product','relatedProducts', 'upSellProducts', 'reviews'));
    }

    /**
     * Get reviews for the given product.
     *
     * @param \Modules\Product\Entities\Product $product
     * @return \Illuminate\Support\Collection
     */
    private function getReviews($product)
    {
        if (! Stg::get('reviews_enabled')) {
            return collect();
        }

        return $product->reviews()->paginate(15, ['*'], 'reviews');
    }

}