<?php


namespace Tir\Store\Product\Controllers;


use Illuminate\Routing\Controller;
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
        $relatedProducts = collect();
        $upSellProducts = collect();
        $reviews = collect();

//        if (Stg::get('reviews_enabled')) {
//            $product->load('reviews:product_id,rating');
//        }

        //event(new ProductViewed($product));

        return view('storefront::public.products.show', compact('product','relatedProducts', 'upSellProducts', 'reviews'));
    }

}