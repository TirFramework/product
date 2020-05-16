<?php

namespace Tir\Store\Review\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Tir\Setting\Facades\Stg;
use Tir\Store\Product\Entities\Product;
use Tir\Store\Review\Requests\StoreReviewRequest;

class ProductReviewController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param int $productId
     * @param StoreReviewRequest $request
     * @return Response
     */
    public function store($productId, StoreReviewRequest $request)
    {

        if (! Stg::get('reviews_enabled')) {
            return back();
        }

        Product::findOrFail($productId)
            ->reviews()
            ->create([
                'reviewer_id' => auth()->id(),
                'rating' => $request->rating,
                'reviewer_name' => $request->reviewer_name,
                'comment' => $request->comment,
                'is_approved' => Stg::get('auto_approve_reviews', 0),
            ]);

        return back()->withSuccess($this->message());
    }

    /**
     * Returns the success message.
     *
     * @return string
     */
    private function message()
    {
        if (Stg::get('auto_approve_reviews')) {
            return trans('review::messages.thank_you');
        }

        return trans('review::messages.submitted_for_approval');
    }
}
